<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        //Empleados fijos
        Empleado::create([
            'nombreEmpleado' => 'Juan',
            'apellidoEmpleado' => 'Pérez',
            'correoEmpleado' => 'juan@example.com',
            'direccionEmpleado' => 'Barrio Central'
        ]);
        Empleado::create([
            'nombreEmpleado' => 'Leandro',
            'apellidoEmpleado' => 'Matus',
            'correoEmpleado' => 'matusleandro12@gmail.com',
            'direccionEmpleado' => 'Barrio Aquiles Bonucci'
        ]);

        //Empleados aleatorios
        Empleado::factory()->count(10)->create();
    }
}


