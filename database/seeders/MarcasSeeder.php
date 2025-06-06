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
        Marca::firstOrCreate(['nombreMarca' => 'Huevos El Granjero']);
        Marca::firstOrCreate(['nombreMarca' => 'Unilever']);
        Marca::firstOrCreate(['nombreMarca' => 'Colgate-Palmolive']);
        Marca::firstOrCreate(['nombreMarca' => 'Fanta']);
        Marca::firstOrCreate(['nombreMarca' => 'Aqua Fina']);
        Marca::firstOrCreate(['nombreMarca' => 'Pozuelo']);
        Marca::firstOrCreate(['nombreMarca' => 'Oreo']);
        Marca::firstOrCreate(['nombreMarca' => 'Quaker']);
        Marca::firstOrCreate(['nombreMarca' => 'Eskimo']);
        Marca::firstOrCreate(['nombreMarca' => 'Maruchan']);
        Marca::firstOrCreate(['nombreMarca' => 'Azúcar San Antonio']);
        Marca::firstOrCreate(['nombreMarca' => 'Arroz Faisan']);
        Marca::firstOrCreate(['nombreMarca' => 'Propet']);
        Marca::firstOrCreate(['nombreMarca' => 'Aceite Norteño']);
        Marca::firstOrCreate(['nombreMarca' => 'Naturas']);
        Marca::firstOrCreate(['nombreMarca' => 'La Sirena']);
        Marca::firstOrCreate(['nombreMarca' => 'Maggi']);
        Marca::firstOrCreate(['nombreMarca' => 'Mazola']);
        Marca::firstOrCreate(['nombreMarca' => 'Kotex']);
        Marca::firstOrCreate(['nombreMarca' => 'Raptor']);

        // Marcas aleatorias
        Marca::factory()->count(10)->create();
    }
}
