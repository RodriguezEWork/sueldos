<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            [
                'nombre' => 'Antiguedad',
                'tipo' => 'Porcentaje',
                'concepto' => 'adicional',
                'base' => 1,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'Presentismo',
                'tipo' => 'Porcentaje',
                'concepto' => 'adicional',
                'base' => 8.33,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'Horas extras 50%',
                'tipo' => 'Porcentaje',
                'concepto' => 'adicional',
                'base' => 150,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'Horas extras 100%',
                'tipo' => 'Porcentaje',
                'concepto' => 'adicional',
                'base' => 200,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'Jubilacion',
                'tipo' => 'Porcentaje',
                'concepto' => 'descuento',
                'base' => 11,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'Ley 19.032',
                'tipo' => 'Porcentaje',
                'concepto' => 'descuento',
                'base' => 3,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'Obra social',
                'tipo' => 'Porcentaje',
                'concepto' => 'descuento',
                'base' => 3,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'S.E.C. Art. 100 CCT 130/75',
                'tipo' => 'Porcentaje',
                'concepto' => 'descuento',
                'base' => 2,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'F.A.E.C.y.S. Art. 100 CCT 130/75',
                'tipo' => 'Porcentaje',
                'concepto' => 'descuento',
                'base' => 0.5,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'S.E.C. Art. 101 CCT 130/75',
                'tipo' => 'Porcentaje',
                'concepto' => 'descuento',
                'base' => 2,
                'raiz' => 'sueldo',
            ],
            [
                'nombre' => 'OSECAC',
                'tipo' => 'Fijo',
                'concepto' => 'descuento',
                'base' => 100.00,
                'raiz' => 'sueldo',
            ],
        ];
    }
} 