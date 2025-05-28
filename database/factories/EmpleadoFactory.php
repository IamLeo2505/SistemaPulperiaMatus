<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'nombreEmpleado' => $this->faker->firstName(),
            'apellidoEmpleado' => $this->faker->lastName(),
            'correoEmpleado' => $this->faker->unique()->safeEmail(),
            'direccionEmpleado' => $this->faker->address(),
        ];
    }
}
