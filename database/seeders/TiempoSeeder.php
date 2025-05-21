<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tiempo;
use Illuminate\Database\Seeder;

class TiempoSeeder extends Seeder
{
    public function run()
    {
        Tiempo::create([
            'fecha' => now(),
            'año' => now()->year,
            'mes' => now()->month,
            'dia' => now()->day,
            'trimestre' => 2,
            'horario' => now()->format('H:i:s')
        ]);
    }
}

