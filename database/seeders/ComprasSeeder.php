<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Compra;
use Illuminate\Database\Seeder;

class ComprasSeeder extends Seeder
{
    public function run()
    {
        // Compras fijas
        Compra::create([
            'ncompra' => '1',
            'fecha' => now(),
            'subtotal' => 80,
            'descuento' => 5,
            'iva' => 10.4,
            'total' => 85.4,
            'empleado_id' => 1,
            'proveedor_id' => 1,
            'usuario_id' => 1
        ]);

        /* 
         * Compras aleatorias
         * Descomentar la siguiente línea para generar compras aleatorias
        */

        // Compra::factory(10)->create();

    }
}
