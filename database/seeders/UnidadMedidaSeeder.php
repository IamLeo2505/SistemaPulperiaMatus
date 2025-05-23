<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Unidad_Medida;
use Illuminate\Database\Seeder;

class UnidadMedidaSeeder extends Seeder
{
    public function run()
    {
        Unidad_Medida::create(['nombre_unidad' => 'Litros']);
        Unidad_Medida::create(['nombre_unidad' => 'Unidades']);
    }
}

