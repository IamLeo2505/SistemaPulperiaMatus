<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarcaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombreMarca' => $this->faker->unique()->company,
        ];
    }
}
