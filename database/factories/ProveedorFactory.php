<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'nombreProveedor' => $this->faker->FirstName(),
            'apellidoProveedor' => $this->faker->LastName(),
            'compañía' => $this->faker->company(),
            'numeroProveedor' => $this->faker->unique()->numerify('########'),
        ];
    }
}
