<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        Empleado::create([
            'nombreEmpleado' => 'Juan',
            'apellidoEmpleado' => 'Pérez',
            'correoEmpleado' => 'juan@example.com',
            'direccionEmpleado' => 'Barrio Central'
        ]);
    }
}


