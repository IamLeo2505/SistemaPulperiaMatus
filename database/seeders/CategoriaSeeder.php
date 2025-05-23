<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        Categoria::create(['nombre_categoria' => 'Bebidas']);
        Categoria::create(['nombre_categoria' => 'Lácteos']);
    }
}
