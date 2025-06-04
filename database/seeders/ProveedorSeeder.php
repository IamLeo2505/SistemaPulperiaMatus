<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        //Proveedores fijos
        Proveedor::create([
            'nombreProveedor' => 'Carlos',
            'apellidoProveedor' => 'Lopez',
            'compañía' => 'Distribuidora Rizo Jarquín',
            'numeroProveedor' => '88881234'
        ]);
        Proveedor::create([
            'nombreProveedor' => 'Mario',
            'apellidoProveedor' => 'Soza',
            'compañía' => 'Coca-Cola',
            'numeroProveedor' => '89784557'
        ]);
        Proveedor::create([
            'nombreProveedor' => 'Manuel',
            'apellidoProveedor' => 'López',
            'compañía' => 'Bimbo',
            'numeroProveedor' => '84025484'
        ]);

        Proveedor::create([
            'nombreProveedor' => 'Ángel',
            'apellidoProveedor' => 'Soto',
            'compañía' => 'Huevos El Granjero',
            'numeroProveedor' => '87456545'
        ]);

        /*Proveedores aleatorios
        Proveedor::factory()->count(10)->create();*/
    }
}
