<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DetalleCompra;
use Illuminate\Database\Seeder;

class DetalleComprasSeeder extends Seeder
{
    public function run()
    {
        // Detalles de compra fijos
        DetalleCompra::create([
            'cantidad' => 10,
            'precio_compra' => 1,
            'subtotal' => 10,
            'total' => 11.3,
            'compra_id' => 1,
            'producto_id' => 1
        ]);

        /* 
        /   Detalles de compra aleatorios
        *   Descomentar la siguiente línea para generar detalles de compra aleatorios
        */

        // DetalleCompra::factory()->count(10)->create();
    }
}

