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
        // Crear 3 supervisores
        for ($i = 1; $i <= 1; $i++) {
            User::create([
                'name' => "Supervisor{$i}",
                'apellido' => "Apellido{$i}",
                'dni' => "3000000{$i}",
                'fecha_nacimiento' => '1980-01-01',
                'direccion' => "Dirección Supervisor {$i}",
                'telefono' => "11111111{$i}",
                'email' => "supervisor{$i}@example.com",
                'fecha_ingreso' => '2020-01-01',
                'cargo_id' => 1,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }

        User::create([
            'name' => "Juan",
            'apellido' => "Pérez",
            'dni' => "20000001",
            'fecha_nacimiento' => '1985-05-15',
            'direccion' => "Av. Principal 123",
            'telefono' => "2222222201",
            'email' => "juan.perez@example.com",
            'fecha_ingreso' => '2019-03-01',
            'cargo_id' => 2,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => "Ana",
            'apellido' => "Gómez",
            'dni' => "20000002",
            'fecha_nacimiento' => '1992-07-08',
            'direccion' => "Calle Secundaria 456",
            'telefono' => "2222222202",
            'email' => "ana.gomez@example.com",
            'fecha_ingreso' => '2020-08-15',
            'cargo_id' => 2,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => "Carlos",
            'apellido' => "López",
            'dni' => "20000003",
            'fecha_nacimiento' => '1988-02-20',
            'direccion' => "Camino Vecinal 789",
            'telefono' => "2222222203",
            'email' => "carlos.lopez@example.com",
            'fecha_ingreso' => '2021-05-30',
            'cargo_id' => 2,
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
} 