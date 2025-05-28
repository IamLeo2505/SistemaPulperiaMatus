<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Unidad_MedidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unidad_medida' => faker()->unique()->word(),
        ];
    }
}
