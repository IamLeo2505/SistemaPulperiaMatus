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
        //Usuarios fijos
        Usuario::create([
            'user' => 'admin',
            'password' => Hash::make('password123'),
            'empleado_id' => 1,
            'image_path_Usuarios' => 'profile_images/ft_leo.jpg'
        ]);

        /*
        *  Usuarios aleatorios
        *  Descomentar la siguiente linea para generar usuarios aleatorios
        */
        
        // Usuario::factory(10)->create();
    }
}
