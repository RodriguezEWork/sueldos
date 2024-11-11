<?php

namespace Database\Seeders;

use App\Enums\TiposType;
use App\Models\User;
use App\Models\Bonificacion;
use Illuminate\Database\Seeder;

class BonificacionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $tipos = TiposType::all();
        
        foreach ($users as $user) {
            // Generar bonificaciones para cada mes
            for ($mes = 1; $mes <= 12; $mes++) {
                // Seleccionar aleatoriamente 3-5 tipos de bonificación
                $tiposSeleccionados = $tipos->random(rand(3, 5));
                
                foreach ($tiposSeleccionados as $tipo) {
                    Bonificacion::create([
                        'tipo_id' => $tipo->id,
                        'fecha' => "2024-{$mes}-01",
                        'user_id' => $user->id,
                        'cantidad' => $this->getCantidadPorTipo($tipo->nombre)
                    ]);
                }
            }
        }
    }

    private function getCantidadPorTipo($tipoNombre)
    {
        return match($tipoNombre) {
            'Horas extras 50%' => rand(1, 20), // Entre 1 y 20 horas
            'Horas extras 100%' => rand(1, 10), // Entre 1 y 10 horas
            'Presentismo' => rand(0, 1), // 0 = no presentismo, 1 = presentismo
            'Antiguedad' => rand(1, 10), // Entre 1 y 10 años
            default => 1, // Valor por defecto para otros tipos
        };
    }
} 