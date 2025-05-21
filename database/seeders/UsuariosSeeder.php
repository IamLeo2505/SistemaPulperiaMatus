<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'user' => 'admin',
            'password' => Hash::make('password123'),
            'empleado_id' => 1,
            'image_path_Usuarios' => 'default.png'
        ]);
    }
}
