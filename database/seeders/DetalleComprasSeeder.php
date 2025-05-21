<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DetalleCompra;
use Illuminate\Database\Seeder;

class DetalleComprasSeeder extends Seeder
{
    public function run()
    {
        DetalleCompra::create([
            'cantidad' => 10,
            'precio_compra' => 1,
            'subtotal' => 10,
            'total' => 11.3,
            'compra_id' => 1,
            'producto_id' => 1
        ]);
    }
}

