<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tiempo>
 */
class TiempoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha' => $this->faker->date('Y-m-d'),
            'año' => $this->faker->year,
            'mes' => $this->faker->month,
            'dia' => $this->faker->dayOfMonth,
            'trimestre' => $this->faker->randomElement([1, 2, 3,]),
            'horario' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]),
        ];
    }
}
