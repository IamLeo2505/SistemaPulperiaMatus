<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        //Categorias fijas
        /*1*/ Categoria::create(['nombre_categoria' => 'Energizantes']);
        /*2*/ Categoria::create(['nombre_categoria' => 'Lácteos']);
        /*3*/ Categoria::create(['nombre_categoria' => 'Verduras']);
        /*4*/ Categoria::create(['nombre_categoria' => 'Sopa Instantánea']);
        /*5*/ Categoria::create(['nombre_categoria' => 'Farmacia']);
        /*6*/ Categoria::create(['nombre_categoria' => 'Limpieza del Hogar']);
        /*7*/ Categoria::create(['nombre_categoria' => 'Higiene Personal']);
        /*8*/ Categoria::create(['nombre_categoria' => 'Cereales']);
        /*9*/Categoria::create(['nombre_categoria' => 'Abarrotes']);
        /*10*/Categoria::create(['nombre_categoria' => 'Panadería']);
        /*11*/Categoria::create(['nombre_categoria' => 'Condimentos']);
        Categoria::create(['nombre_categoria' => 'Confitería']);
        Categoria::create(['nombre_categoria' => 'Alimentos para Mascotas']);
        Categoria::create(['nombre_categoria' => 'Botanas']);
        Categoria::create(['nombre_categoria' => 'Carnes y Aves']);
        Categoria::create(['nombre_categoria' => 'Embutidos']);
        Categoria::create(['nombre_categoria' => 'Papelería']);
        Categoria::create(['nombre_categoria' => 'Otros Productos']);
        Categoria::create(['nombre_categoria' => 'Gaseosas']);
        Categoria::create(['nombre_categoria' => 'Jugos']);
        Categoria::create(['nombre_categoria' => 'Snacks']);
        Categoria::create(['nombre_categoria' => 'Granos Básicos']);
        Categoria::create(['nombre_categoria' => 'Huevos']);
        Categoria::create(['nombre_categoria' => 'Aceites y Vinagres']);

        /*
        *   Categorias aleatorias
        *   Descomentar la siguiente línea para generar categorías aleatorias
        */
         
        //Categoria::factory()->count(10)->create();
        
    }
}
