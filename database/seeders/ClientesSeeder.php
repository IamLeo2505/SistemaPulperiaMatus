<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        // Clientes fijos
        Cliente::create([
            'nombreCliente' => 'Ana',
            'apellidoCliente' => 'Martínez',
            'numeroCliente' => '88882222',
            'edad' => 30,
            'genero' => '0',
            'estado' => '1'
        ]);

        // Clientes aleatorios
        Cliente::factory()->count(10)->create();
    }
}
