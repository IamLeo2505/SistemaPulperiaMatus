<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DetalleVenta;
use Illuminate\Database\Seeder;

class DetalleVentasSeeder extends Seeder
{
    public function run()
    {
        DetalleVenta::create([
            'cantidad' => 2,
            'precio' => 1.5,
            'descuento' => 0,
            'subtotal' => 3,
            'total' => 3,
            'venta_id' => 1,
            'producto_id' => 1
        ]);
    }
}
