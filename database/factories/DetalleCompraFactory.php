<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleCompraFactory extends Factory
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
            'cantidad' => $this->faker->numberBetween(1, 100),
            'precio_compra' => $this->faker->numberBetween(100, 1000),
            'subtotal' => $subtotal,
            'descuento' => $descuento,
            'iva' => $iva,
            'total' => $total,
            'compra_id' => 1,
            'producto_id'=> 1
        ];
    }
}
