<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombreCliente' => $this->faker->firstName,
            'apellidoCliente' => $this->faker->lastName,
            'numeroCliente' => $this->faker->unique()->numerify('########'),
            'edad' => $this->faker->numberBetween(18, 65),
            'genero' => $this->faker->randomElement(['0', '1']), // 0 = Femenino, 1 = Masculino
            'estado' => $this->faker->randomElement(['0', '1']), // 0 = Inactivo, 1 = Activo
        ];
    }
}
