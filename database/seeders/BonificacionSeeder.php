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
        $bonifMedic = self::licMedic();

        // Insertar los registros en la base de datos
        DB::table('bonificaciones')->insert($bonifMedic);
    }

    private function licMedic() {
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
}
