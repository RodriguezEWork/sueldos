<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cargo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $cargoSupervisor = Cargo::where('nombre', 'Supervisor')->first();
        
        // Crear 3 supervisores
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'nombre' => "Supervisor{$i}",
                'apellido' => "Apellido{$i}",
                'dni' => "3000000{$i}",
                'fecha_nacimiento' => '1980-01-01',
                'direccion' => "Dirección Supervisor {$i}",
                'telefono' => "11111111{$i}",
                'email' => "supervisor{$i}@example.com",
                'fecha_ingreso' => '2020-01-01',
                'cargo_id' => $cargoSupervisor->id,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Crear 15 trabajadores
        $cargoTrabajador = Cargo::where('nombre', 'Director')->first();
        
        for ($i = 1; $i <= 15; $i++) {
            User::create([
                'nombre' => "Trabajador{$i}",
                'apellido' => "Apellido{$i}",
                'dni' => "2000000{$i}",
                'fecha_nacimiento' => '1990-01-01',
                'direccion' => "Dirección Trabajador {$i}",
                'telefono' => "22222222{$i}",
                'email' => "trabajador{$i}@example.com",
                'fecha_ingreso' => '2021-01-01',
                'cargo_id' => $cargoTrabajador->id,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
} 