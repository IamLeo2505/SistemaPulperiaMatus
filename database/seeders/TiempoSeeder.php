<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tiempo;
use Illuminate\Database\Seeder;

class TiempoSeeder extends Seeder
{
    public function run()
    {
        // Tiempo fijo
        Tiempo::create([
            'fecha' => now(),
            'año' => now()->year,
            'mes' => now()->month,
            'dia' => now()->day,
            'trimestre' => 2,
            'horario' => now()->format('H:i:s')
        ]);

        /*
        * Tiempo aleatorio
        * Descomentar para generar 10 registros aleatorios
        */

        //Tiempo::factory(10)->create();
    }
}

