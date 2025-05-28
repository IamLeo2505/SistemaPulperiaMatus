<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    public function run()
    {
        // Marcas fijas
        Marca::firstOrCreate(['nombreMarca' => 'Nestlé']);
        Marca::firstOrCreate(['nombreMarca' => 'Coca Cola Company']);
        Marca::firstOrCreate(['nombreMarca' => 'Pepsi']);
        Marca::firstOrCreate(['nombreMarca' => 'Unilever']);
        Marca::firstOrCreate(['nombreMarca' => 'Colgate-Palmolive']);
                
        // Marcas aleatorias
        Marca::factory()->count(10)->create();
    }
}
