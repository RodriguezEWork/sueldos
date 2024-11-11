<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resultado;
use App\Models\Factura;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $año = $request->get('año');
        $userId = $request->get('user_id');

        if ($userId) {
            $this->generarFacturaUsuario($userId, $mes, $año);
        } else {
            User::chunk(100, function($users) use ($mes, $año) {
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
        // Verificar si ya existe la factura
        if (Factura::where('user_id', $userId)
            ->where('mes', $mes)
            ->where('año', $año)
            ->exists()) {
            return;
        }

        // Obtener resultados
        $resultado = Factura::where('user_id', $userId)
            ->where('mes', $mes)
            ->where('año', $año)
            ->first();

        if (!$resultado) {
            return;
        }

        // Crear factura
        Factura::create([
            'user_id' => $userId,
            'mes' => $mes,
            'año' => $año,
            'resultado_id' => $resultado->id,
            // Otros campos necesarios...
        ]);
    }

    public function pdf(Request $request)
    {
        $factura = Factura::where('mes', $request->mes)
            ->where('año', $request->año)
            ->where('user_id', $request->user_id)
            ->firstOrFail();

        $pdf = Pdf::loadView('facturas.pdf', compact('factura'));
        
        return $pdf->stream('factura.pdf');
    }
} 