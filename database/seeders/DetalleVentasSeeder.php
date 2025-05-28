<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DetalleVenta;
use Illuminate\Database\Seeder;

class DetalleVentasSeeder extends Seeder
{
    public function run()
    {
        // Detalles de venta fijos
        DetalleVenta::create([
            'cantidad' => 2,
            'precio' => 1.50,
            'descuento' => 0,
            'subtotal' => 3,
            'total' => 3,
            'venta_id' => 1,
            'producto_id' => 1
        ]);

        /* 
         * Detalles de venta aleatorios
         * Descomentar la siguiente línea para generar detalles de venta aleatorios
        */

        // DetalleVenta::factory()->count(10)->create();
    }
}
