<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    public function run()
    {
        Marca::create(['nombreMarca' => 'Nestlé']);
        Marca::create(['nombreMarca' => 'Coca Cola']);
    }
}
