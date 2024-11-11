<?php

namespace App\Http\Controllers;

use App\Models\Bonificacion;
use Illuminate\Http\Request;

class BonificacionController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));
        
        // Obtener las bonificaciones para el año seleccionado
        $bonificaciones = Bonificacion::whereYear('fecha', $year)
            ->get()
            ->groupBy(function($bonificacion) {
                return date('n', strtotime($bonificacion->fecha));
            });

        return view('payouts.index', compact('bonificaciones'));
    }

    public function edit($mes, $año)
    {
        // Aquí irá la lógica para editar las bonificaciones de un mes específico
        return view('bonificaciones.edit', compact('mes', 'año'));
    }

    public function update(Request $request, $mes, $año)
    {
        // Aquí irá la lógica para actualizar las bonificaciones
    }
} 