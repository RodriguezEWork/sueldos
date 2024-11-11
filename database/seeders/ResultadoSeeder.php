<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Resultado;
use Illuminate\Database\Seeder;

class ResultadoSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            for ($mes = 1; $mes <= 12; $mes++) {
                Resultado::create([
                    'user_id' => $user->id,
                    'mes' => $mes,
                    'año' => 2024,
                    'antiguedad' => rand(1000, 5000),
                    'presentismo' => rand(5000, 10000),
                    'horas_extras_50' => rand(2000, 8000),
                    'horas_extras_100' => rand(4000, 12000),
                    'jubilacion' => rand(5000, 15000),
                    'ley_19032' => rand(1000, 3000),
                    'obra_social' => rand(2000, 4000),
                    'sec_art_100' => rand(1000, 3000),
                    'faecys_art_100' => rand(500, 1500),
                    'sec_art_101' => rand(1000, 3000),
                    'osecac' => 100
                ]);
            }
        }
    }
} 