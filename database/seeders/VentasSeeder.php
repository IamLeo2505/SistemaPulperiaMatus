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
            'nventa' => 1,
            'subtotal' => 543,
            'descuento' => 45.9,
            'iva' => 74.565,
            'total' => 571.665,
            'fecha' => now(),
            'empleado_id' => 1,
            'cliente_id' => 1,
            'usuario_id' => 1
        ]);

        Venta::create([
            'nventa'=> 2,
            'subtotal'=> 515,
            'descuento'=> 49,
            'iva'=> 69.9,
            'total'=> 535.9,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 2,
            'usuario_id' => 1
        ]);

        Venta::create([
            'nventa'=> 3,
            'subtotal'=> 532,
            'descuento'=> 37,
            'iva'=> 74.25,
            'total'=> 569.25
            ,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 3,
            'usuario_id' => 1
        ]);

        Venta::create([
            'nventa'=> 4,
            'subtotal'=> 598.00,
            'descuento'=> 35.00,
            'iva'=> 84.45,
            'total'=> 647.45,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 4,
            'usuario_id' => 1
        ]);

        Venta::create([
            'nventa'=> 5,
            'subtotal'=> 646.50,
            'descuento'=> 55.00,
            'iva'=> 88.725,
            'total'=> 680.23,
            'fecha'=> now(),
            'empleado_id'=> 1,
            'cliente_id'=> 5,
            'usuario_id' => 1
        ]);

        /*
        * Ventas aleatorias
        * Descomentar el siguiente código para generar ventas aleatorias
        */
        //Venta::factory(10)->create();
    }
}

