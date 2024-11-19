<?php

namespace App\Http\Controllers;

use App\Enums\TiposType;
use App\Models\Bonificacion;
use App\Models\User;
use App\Models\Resultado;
use App\Models\Factura;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FacturaController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('apellido')->get();
        $year = $request->get('year', date('Y'));
        $userId = $request->get('user_id');

        $query = Factura::whereYear('created_at', $year);
        if ($userId) {
            $query->where('user_id', $userId);
        }

        $facturas = $query->get()->groupBy(function($factura) {
            return date('n', strtotime($factura->created_at));
        });

        return view('facturas.index', compact('users', 'facturas'));
    }

    public function generar(Request $request)
    {
        $mes = $request->get('mes');
        $año = $request->get('year');
        $userId = $request->get('user_id');
        $users = User::orderBy('apellido')->get();
        if ($userId) {
            $this->generarFacturaUsuario($userId, $mes, $año);
        } else {
            User::chunk(100, function($args) use ($mes, $año, $users) {
                foreach($users as $user) {
                    $this->generarFacturaUsuario($user->id, $mes, $año);
                }
            });
        }

        return redirect()->route('facturas.index', ['year' => $año, 'user_id' => $userId])
            ->with('success', 'Facturas generadas correctamente');
    }

    public function generarTodo(Request $request)
    {
        $año = $request->get('año');
        $userId = $request->get('user_id');

        if ($userId) {
            for ($mes = 1; $mes <= 12; $mes++) {
                $this->generarFacturaUsuario($userId, $mes, $año);
            }
        } else {
            User::chunk(100, function($users) use ($año) {
                foreach($users as $user) {
                    for ($mes = 1; $mes <= 12; $mes++) {
                        $this->generarFacturaUsuario($user->id, $mes, $año);
                    }
                }
            });
        }

        return redirect()->route('facturas.index', ['year' => $año, 'user_id' => $userId])
            ->with('success', 'Todas las facturas fueron generadas correctamente');
    }

    private function generarFacturaUsuario($userId, $mes, $año)
    {
        if (Factura::where('user_id', $userId)
            ->where('mes', $mes)
            ->where('año', $año)
            ->exists()) {
            return;
        }
        
        $user = User::find($userId);
        $sueldo = $user->cargo->sueldo_base; 

        $antiguedad = $user->fecha_ingreso->diffInYears(now());
        $presentismo = Bonificacion::whereIn('tipo', [TiposType::LICENCIA_MEDICA, TiposType::LICENCIA_MATERNA, TiposType::INJUSTIFICADO])
            ->where('user_id', $userId)
            ->where('fecha', "=>" , Carbon::create("01-$mes-$año")->startOfMonth()->format('Y-m-d'))
            ->where('fecha', "<=", Carbon::create("01-$mes-$año")->endOfMonth()->format('Y-m-d'))
            ->count();

        //Presentismo
        //Un plus del 8,33% que se otorga si el empleado no tuvo inasistencias o llegadas tarde injustificadas en el mes.            
        
        $presentismo = $presentismo > 3 ? 0 : $sueldo * 0.0833; 

        //Horas Extras
        //50% (horas extra diurnas): Se pagan al 150% del valor de la hora ordinaria.
        //100% (horas extra nocturnas o en días feriados): Se pagan al 200% del valor de la hora ordinaria.

        $horas = $sueldo / 160;
        
        // Filtrado para extra 50%: Entre las 00:00 de lunes y las 12:00 del sábado
        $extras_50 = Bonificacion::where('tipo', TiposType::EXTRAS)
            ->where('user_id', $userId)
            ->where('fecha', '>=', Carbon::create("01-$mes-$año")->startOfMonth()->format('Y-m-d'))
            ->where('fecha', '<=', Carbon::create("01-$mes-$año")->endOfMonth()->format('Y-m-d'))
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('start_time', '>=', '00:00:00')
                    ->where('start_time', '<=', '23:59:59')
                    ->whereDay('fecha', '=', Carbon::MONDAY);
                })->orWhere(function ($q) {
                    $q->where('end_time', '<=', '12:00:00')
                    ->whereDay('fecha', '<=', Carbon::SATURDAY);
                });
            })
            ->count();

        $extras_50 = ($horas * 0.150) * $extras_50;

        // Filtrado para extra 100%: Entre las 12:00 del sábado y las 23:59 del domingo
        $extras_100 = Bonificacion::where('tipo', TiposType::EXTRAS)
            ->where('user_id', $userId)
            ->where('fecha', '>=', Carbon::create("01-$mes-$año")->startOfMonth()->format('Y-m-d'))
            ->where('fecha', '<=', Carbon::create("01-$mes-$año")->endOfMonth()->format('Y-m-d'))
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('start_time', '>=', '12:00:00')
                    ->whereDay('fecha', '=', Carbon::SATURDAY);
                })->orWhere(function ($q) {
                    $q->where('end_time', '<=', '23:59:59')
                    ->whereDay('fecha', '=', Carbon::SUNDAY);
                });
            })
            ->count();

        $extras_100 = ($horas * 0.150) * $extras_100;

        // Filtrado para extra 100%: Entre las 12:00 del sábado y las 23:59 del domingo
        $vacaciones = Bonificacion::where('tipo', TiposType::VACACIONES)
            ->where('user_id', $userId)
            ->where('fecha', '>=', Carbon::create("01-$mes-$año")->startOfMonth()->format('Y-m-d'))
            ->where('fecha', '<=', Carbon::create("01-$mes-$año")->endOfMonth()->format('Y-m-d'))
            ->count();

        $sueldo_final = $sueldo + ($antiguedad * 0.01) + $presentismo + $extras_50 + $extras_100;
        $sueldo_vacaciones = $sueldo_final / 25; 

        Factura::create([
            'user_id' => $userId,
            'mes' => $mes,
            'año' => $año,
            'antiguedad' => ($sueldo * 0.01) * $antiguedad,
            'presentismo' => $presentismo,
            'horas_extras_50' => $extras_50,
            'horas_extras_100' => $extras_100,
            'jubilacion' => $sueldo_final * 0.11,
            'ley_19032' => $sueldo_final * 0.03,
            'obra_social' => $sueldo_final * 0.03,
            'sec_art_100' => $sueldo_final * 0.02,
            'faecys_art_100' => $sueldo_final * 0.005,
            'sec_art_101' => $sueldo_final * 0.02,
            'vacaciones' => $sueldo_vacaciones * $vacaciones,
            'osecac' => 100,
        ]);
    }

    public function pdf(Request $request)
    {
        $factura = Factura::where('mes', $request->mes)
            ->where('año', $request->year)
            ->where('user_id', $request->user_id)
            ->firstOrFail();

        $pdf = Pdf::loadView('facturas.pdf', compact('factura'));
        
        return $pdf->stream('factura.pdf');
    }
} 