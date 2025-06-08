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
        /*12*/Categoria::create(['nombre_categoria' => 'Confitería']);
        /*13*/Categoria::create(['nombre_categoria' => 'Alimentos para Mascotas']);
        /*14*/Categoria::create(['nombre_categoria' => 'Botanas']);
        /*15*/Categoria::create(['nombre_categoria' => 'Carnes y Aves']);
        /*16*/Categoria::create(['nombre_categoria' => 'Embutidos']);
        /*17*/Categoria::create(['nombre_categoria' => 'Papelería']);
        /*18*/Categoria::create(['nombre_categoria' => 'Otros Productos']);
        /*19*/Categoria::create(['nombre_categoria' => 'Gaseosas']);
        /*20*/Categoria::create(['nombre_categoria' => 'Jugos']);
        /*21*/Categoria::create(['nombre_categoria' => 'Snacks']);
        /*22*/Categoria::create(['nombre_categoria' => 'Granos Básicos']);
        /*23*/Categoria::create(['nombre_categoria' => 'Huevos']);
        /*24*/Categoria::create(['nombre_categoria' => 'Aceites y Vinagres']);
        /*25*/Categoria::create(['nombre_categoria' => 'Utiles Escolares']);

        /*
        *   Categorias aleatorias
        *   Descomentar la siguiente línea para generar categorías aleatorias
        */
         
        //Categoria::factory()->count(10)->create();
        
    }
}
