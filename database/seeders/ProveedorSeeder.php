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
            'compañía' => 'Distribuidora Sur',
            'numeroProveedor' => '88881234'
        ]);

        //Proveedores aleatorios
        Proveedor::factory()->count(10)->create();
    }
}
