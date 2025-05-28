<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        // Productos fijos
        Producto::create([
            'image_path' => 'productos/cocacola.jpg',
            'nombreProducto' => 'Coca Cola 1L',
            'descripcion' => 'Refresco',
            'codigo_barras' => '123456789',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 1.5,
            'unidad_medida_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 2
        ]);

        // Productos aleatorios
        Producto::factory()->count(10)->create();
    }
}
