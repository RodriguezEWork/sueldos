<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = [
            [
                'nombre' => 'Director',
                'sueldo_base' => 700000,
            ],
            [
                'nombre' => 'Supervisor',
                'sueldo_base' => 500000,
            ],
            [
                'nombre' => 'Operario',
                'sueldo_base' => 300000,
            ],
        ];

        foreach ($cargos as $cargo) {
            Cargo::create($cargo);
        }
    }
} 