<?php

namespace Database\Seeders;

use App\Enums\TiposType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $extras = self::extras();

        // Insertar los registros en la base de datos
        DB::table('bonificaciones')->insert($extras);

        $vacaciones = self::vacaciones();
        DB::table('bonificaciones')->insert($vacaciones);

    }

    private function extras() {
        $bonificaciones = [];

        $users = [2, 3, 4];
        $meses = [1, 2, 3, 6, 8]; // Tres meses: enero, febrero y marzo

        foreach ($users as $user) {
            foreach ($meses as $mes) {
                $dia = random_int(1, 28); // Día aleatorio dentro del mes
                $fecha = "2024-$mes-$dia";

                $startTime = "22:00:00"; // Fuera de horario laboral
                $endTime = "23:59:00";

                $bonificaciones[] = [
                    'user_id' => $user,
                    'tipo' => TiposType::EXTRAS,
                    'fecha' => $fecha,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'created_at' => now()
                ];
            }
        }

        return $bonificaciones;
    }

    private function vacaciones() {
        $bonificaciones = [];

        // $users = [2, 3, 4];
        // $meses = [10, 11, 12]; // Tres meses: enero, febrero y marzo

        $startTime = "08:00:00"; // Fuera de horario laboral
        $endTime = "23:59:00";

        $bonificaciones[] = [
            'user_id' => 2,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2020-10-01",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 2,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2020-10-02",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 2,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2020-10-03",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 2,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2020-10-04",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 2,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2020-10-05",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 3,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2022-11-01",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 3,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2022-11-02",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 3,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2022-11-03",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 3,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2022-11-04",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 3,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2022-11-05",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 4,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2024-11-01",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 4,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2024-11-02",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 4,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2024-11-03",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 4,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2024-11-04",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        $bonificaciones[] = [
            'user_id' => 4,
            'tipo' => TiposType::VACACIONES,
            'fecha' => "2024-11-05",
            'start_time' => $startTime,
            'end_time' => $endTime,
            'created_at' => now()
        ];

        return $bonificaciones;
    }
}
