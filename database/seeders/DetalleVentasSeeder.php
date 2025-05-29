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
            'total' => 3.45,
            'venta_id' => 1,
            'producto_id' => 1
        ]);

        DetalleVenta::Create([
            'cantidad' => 3,
            'precio' => 8.00,
            'descuento' => 10,
            'subtotal' => 24,
            'total' => 24.84,
            'venta_id' => 1,
            'producto_id' => 2
        ]);

        DetalleVenta::create([
            'cantidad' => 5,
            'precio' => 25.00,
            'descuento' => 10,
            'subtotal' => 125,
            'total' => 129.375,
            'venta_id' => 1,
            'producto_id' => 3
        ]);

        DetalleVenta::Create([
            'cantidad' => 4,
            'precio' => 15.00,
            'descuento' => 5,
            'subtotal' => 60,
            'total' => 65.55,
            'venta_id' => 1,
            'producto_id' => 4
        ]);

        DetalleVenta::Create([
            'cantidad' => 8,
            'precio' => 35.00,
            'descuento' => 10,
            'subtotal' => 280,
            'total' => 289.8,
            'venta_id' => 1,
            'producto_id' => 5
        ]);

        //2
        DetalleVenta::create([
            'cantidad'=> 5,
            'precio'=> 5.00,
            'descuento'=> 0,
            'subtotal'=> 25,
            'total'=> 28.75,
            'venta_id'=> 2,
            'producto_id'=> 6
        ]);

        DetalleVenta::Create([
            'cantidad'=> 10,
            'precio'=> 1.50,
            'descuento'=> 0,
            'subtotal'=> 15,
            'total'=> 17.25,
            'venta_id'=> 2,
            'producto_id'=> 1
        ]);

        DetalleVenta::Create([
            'cantidad'=> 5,
            'precio'=> 15.00,
            'descuento'=> 10,
            'subtotal'=> 75,
            'total'=> 77.625,
            'venta_id'=> 2,
            'producto_id'=> 4
        ]);
        
        DetalleVenta::Create([
            'cantidad'=> 5,
            'precio'=> 8.00,
            'descuento'=> 10,
            'subtotal'=> 40,
            'total'=> 41.40,
            'venta_id'=> 2,
            'producto_id'=> 2
        ]);
        
        DetalleVenta::Create([
            'cantidad'=> 3,
            'precio'=> 35.00,
            'descuento'=> 10,
            'subtotal'=> 105,
            'total'=> 108.675,
            'venta_id'=> 2,
            'producto_id'=> 5
        ]);

        //////////////////////

DetalleVenta::create([
    'cantidad'=> 1,
    'precio'=> 1.50,
    'subtotal'=> 1.50,
    'descuento'=> 0,
    'total'=> 1.73,
    'venta_id'=> 3,
    'producto_id'=> 1
]);

DetalleVenta::create([
    'cantidad'=> 15,
    'precio'=> 8.00,
    'subtotal'=> 120.00,
    'descuento'=> 10,
    'total'=> 124.20,
    'venta_id'=> 3,
    'producto_id'=> 2
]);

DetalleVenta::create([
    'cantidad'=> 10,
    'precio'=> 25.00,
    'subtotal'=> 250.00,
    'descuento'=> 10,
    'total'=> 258.75,
    'venta_id'=> 3,
    'producto_id'=> 3
]);

DetalleVenta::create([
    'cantidad'=> 5,
    'precio'=> 15.00,
    'subtotal'=> 75.00,
    'descuento'=> 0,
    'total'=> 86.25,
    'venta_id'=> 3,
    'producto_id'=> 4
]);

DetalleVenta::create([
    'cantidad'=> 12,
    'precio'=> 5.00,
    'subtotal'=> 60.00,
    'descuento'=> 0,
    'total'=> 69.00,
    'venta_id'=> 3,
    'producto_id'=> 6
]);

DetalleVenta::create([
    'cantidad'=> 10,
    'precio'=> 35.00,
    'subtotal'=> 350.00,
    'descuento'=> 10,
    'total'=> 362.25,
    'venta_id'=> 4,
    'producto_id'=> 5
]);

DetalleVenta::create([
    'cantidad'=> 1,
    'precio'=> 1.50,
    'subtotal'=> 1.50,
    'descuento'=> 0,
    'total'=> 1.73,
    'venta_id'=> 4,
    'producto_id'=> 1
]);

DetalleVenta::create([
    'cantidad'=> 5,
    'precio'=> 5.00,
    'subtotal'=> 25.00,
    'descuento'=> 0,
    'total'=> 28.75,
    'venta_id'=> 4,
    'producto_id'=> 6
]);

DetalleVenta::create([
    'cantidad'=> 8,
    'precio'=> 5.00,
    'subtotal'=> 40.00,
    'descuento'=> 0,
    'total'=> 46.00,
    'venta_id'=> 4,
    'producto_id'=> 6
]);

DetalleVenta::create([
    'cantidad'=> 2,
    'precio'=> 1.50,
    'subtotal'=> 3.00,
    'descuento'=> 0,
    'total'=> 3.45,
    'venta_id'=> 4,
    'producto_id'=> 1
]);

DetalleVenta::create([
    'cantidad'=> 10,
    'precio'=> 25.00,
    'subtotal'=> 250.00,
    'descuento'=> 10,
    'total'=> 258.75,
    'venta_id'=> 5,
    'producto_id'=> 3
]);

DetalleVenta::create([
    'cantidad'=> 20,
    'precio'=> 15.00,
    'subtotal'=> 300.00,
    'descuento'=> 10,
    'total'=> 310.50,
    'venta_id'=> 5,
    'producto_id'=> 4
]);

DetalleVenta::create([
    'cantidad'=> 1,
    'precio'=> 1.50,
    'subtotal'=> 1.50,
    'descuento'=> 0,
    'total'=> 1.73,
    'venta_id'=> 5,
    'producto_id'=> 1
]);

DetalleVenta::create([
    'cantidad'=> 3,
    'precio'=> 5.00,
    'subtotal'=> 15.00,
    'descuento'=> 0,
    'total'=> 17.25,
    'venta_id'=> 5,
    'producto_id'=> 6
]);

DetalleVenta::create([
    'cantidad'=> 10,
    'precio'=> 8.00,
    'subtotal'=> 80.00,
    'descuento'=> 0,
    'total'=> 92.00,
    'venta_id'=> 5,
    'producto_id'=> 2
]);

        /*'producto_id' => 1
        'precio' => 1.50*/
        /*'producto_id' => 2
        'precio' => 8.00,*/
        /*'producto_id' => 3
        'precio' => 25.00,*/
        /*'producto_id' => 4
        'precio' => 15.00,*/
        /*'producto_id' => 5
        'precio' => 35.00,*/
        /*'producto_id' => 6
        'precio' => 5.00,*/

        /* 
         * Detalles de venta aleatorios
         * Descomentar la siguiente línea para generar detalles de venta aleatorios
        */

        // DetalleVenta::factory()->count(10)->create();
    }
}
