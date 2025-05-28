<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 10, 1000);
        $descuento = $this->faker->randomFloat(2, 0, $subtotal * 0.1);
        $iva = ($subtotal - $descuento) * 0.15; 
        $total = $subtotal - $descuento + $iva;

        return [
            'nventa' => 'C' . $this->faker->unique()->randomNumber(8),
            'fecha' => $this->faker->date(),
            'subtotal' => $subtotal,
            'descuento' => $descuento,
            'iva' => $iva,
            'total' => $total,
            'empleado_id' => Empleado::factory(),
            'cliente_id' => Cliente::factory(),
            'usuario_id' => Usuario::factory(),
        ];
    }
}
