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
        Marca::firstOrCreate(['nombreMarca' => 'Palmolive']);
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
        Marca::firstOrCreate(['nombreMarca' => 'Diana']);
        Marca::firstOrCreate(['nombreMarca' => 'Delisoy']);
        Marca::firstOrCreate(['nombreMarca' => 'Bimbo']);
        Marca::firstOrCreate(['nombreMarca' => 'Bocadeli']);
        Marca::firstOrCreate(['nombreMarca' => 'Yummies']);
        Marca::firstOrCreate(['nombreMarca' => 'Delmor']);
        Marca::firstOrCreate(['nombreMarca' => 'La Sirena']);
        Marca::firstOrCreate(['nombreMarca' => 'Alpina']);
        Marca::firstOrCreate(['nombreMarca' => 'Colgate']);
        Marca::firstOrCreate(['nombreMarca' => 'Pampers']);
        Marca::firstOrCreate(['nombreMarca' => 'Scribe']);
        Marca::firstOrCreate(['nombreMarca' => 'Presto']);
        Marca::firstOrCreate(['nombreMarca' => 'Hi-C']);
        Marca::firstOrCreate(['nombreMarca' => 'Scott']);
        Marca::firstOrCreate(['nombreMarca' => 'Gati']);
        Marca::firstOrCreate(['nombreMarca' => 'Tip-Top']);
        Marca::firstOrCreate(['nombreMarca' => 'Maseca']);


        /* Marcas aleatorias
        Marca::factory()->count(10)->create(); */
    }
}
