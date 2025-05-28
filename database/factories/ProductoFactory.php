<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        // Definimos un array con la información completa de cada producto
        $productosData = [
            [
                'nombre' => 'Coca-Cola',
                'image' => 'productos/cocacola.jpg',
                'descripcion' => 'Una bebida refrescante y burbujeante con sabor original de cola.',
                'precio' => 12.00
            ],
            [
                'nombre' => 'Fanta',
                'image' => 'productos/fanta.jpeg',
                'descripcion' => 'Refresco de naranja vibrante y dulce, perfecto para un día soleado.',
                'precio' =>8.00
            ],
            [
                'nombre' => 'Sprite',
                'image' => 'productos/sprite.jpeg',
                'descripcion' => 'Bebida clara con sabor a lima-limón, limpia y refrescante.',
                'precio' => 10.00
            ],
            [
                'nombre' => 'Agua',
                'image' => 'productos/agua.jpeg',
                'descripcion' => 'Agua pura y cristalina, esencial para la hidratación diaria.',
                'precio' => 10.00
            ],
        ];

        // Seleccionamos un elemento aleatorio de nuestro array de datos de productos
        $productoSeleccionado = $this->faker->randomElement($productosData);

        return [
            'image_path' => $productoSeleccionado['image'],
            'nombreProducto' => $productoSeleccionado['nombre'],
            'descripcion' => $productoSeleccionado['descripcion'],
            'codigo_barras' => $this->faker->unique()->ean13,
            'cantidadstock' => $this->faker->numberBetween(10, 100),
            'fechavencimiento' => $this->faker->dateTimeBetween('+3 months', '+1 year'),
            'precio_producto' => $productoSeleccionado['precio'],
            'unidad_medida_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 2
        ];
    }
}