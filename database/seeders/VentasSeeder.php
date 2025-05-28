<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentasSeeder extends Seeder
{
    public function run()
    {
        //Ventas fijas
        Venta::create([
            'nventa' => '1',
            'subtotal' => 100,
            'descuento' => 5,
            'iva' => 15,
            'total' => 115,
            'fecha' => now(),
            'empleado_id' => 1,
            'cliente_id' => 1
        ]);

        /*
        * Ventas aleatorias
        * Descomentar el siguiente código para generar ventas aleatorias
        */

        //Venta::factory(10)->create();
    }
}

