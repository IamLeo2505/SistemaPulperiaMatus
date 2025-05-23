<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentasSeeder extends Seeder
{
    public function run()
    {
        Venta::create([
            'nventa' => '1',
            'subtotal' => 100,
            'descuento' => 5,
            'iva' => 13,
            'total' => 108,
            'fecha' => now(),
            'empleado_id' => 1,
            'cliente_id' => 1
        ]);
    }
}

