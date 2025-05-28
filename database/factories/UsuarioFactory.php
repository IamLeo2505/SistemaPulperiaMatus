<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user'-> $this->faker->user(),
            'password'-> $this->faker->password(),
            'empleado_id' => 1,
            'image_path_Usuarios'-> $this->faker->image_path()
            
        ];
    }
}
