<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        Cliente::create([
            'nombreCliente' => 'Ana',
            'apellidoCliente' => 'Martínez',
            'numeroCliente' => '88882222',
            'edad' => 30,
            'genero' => '0',
            'estado' => '1'
        ]);
    }
}

