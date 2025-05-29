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
            'subtotal' => 492,
            'descuento' => 45.9,
            'iva' => 70.2,
            'total' => 516.3,
            'fecha' => now(),
            'empleado_id' => 1,
            'cliente_id' => 1
        ]);

        Venta::create([
            'nventa'=> 2,
            'subtotal'=> 260,
            'descuento'=> 22,
            'iva'=> 35.7,
            'total'=> 273.7,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 2
        ]);

        Venta::create([
            'nventa'=> 3,
            'subtotal'=> 505.00,
            'descuento'=> 42.50,
            'iva'=> 69.37,
            'total'=> 531.87,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 3
        ]);

        Venta::create([
            'nventa'=> 4,
            'subtotal'=> 420.00,
            'descuento'=> 35.00,
            'iva'=> 57.75,
            'total'=> 442.75,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 4
        ]);

        Venta::create([
            'nventa'=> 5,
            'subtotal'=> 646.50,
            'descuento'=> 55.00,
            'iva'=> 88.725,
            'total'=> 680.23,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 5
        ]);

        /*
        * Ventas aleatorias
        * Descomentar el siguiente código para generar ventas aleatorias
        */
        //Venta::factory(10)->create();
    }
}

