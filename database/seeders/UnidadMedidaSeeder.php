<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Unidad_Medida;
use Illuminate\Database\Seeder;

class UnidadMedidaSeeder extends Seeder
{
    public function run()
    {
        //Unidades de medida fijas
        Unidad_Medida::create(['nombre_unidad' => 'Litros']);
        Unidad_Medida::create(['nombre_unidad' => 'Unidades']);

        /*
        *   Unidades de medida aleatorias
        *   Descomentar el siguiente código para generar un conjunto de unidades de medida aleatorias
        *   y agregarlas al sistema.
        */

        //Unidad_Medida::factory(10)->create();
    }
}

