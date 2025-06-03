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
            'precio_producto' => 27,
            'unidad_medida_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 2
        ]);

        Producto::create([
            'image_path' => 'productos/agua.png',
            'nombreProducto' => 'Aqua Fina 360ml',
            'descripcion' => 'Agua Potable',
            'codigo_barras' => '987654321',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 8,
            'unidad_medida_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 7
        ]);
        
        Producto::create([
            'image_path' => 'productos/pepsi1l.png',
            'nombreProducto' => 'Pepsi 1L',
            'descripcion' => 'Refresco',
            'codigo_barras' => '1928374655',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 25,
            'unidad_medida_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 3
        ]);

        Producto::create([
            'image_path' => 'productos/pepsi360ml.png',
            'nombreProducto' => 'Pepsi 360ml',
            'descripcion' => 'Refresco',
            'codigo_barras' => '5546372819',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 15,
            'unidad_medida_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 3
        ]);

        Producto::create([
            'image_path' => 'productos/fantanaranja2l.png',
            'nombreProducto' => 'Fanta Naranja 2L',
            'descripcion' => 'Refresco',
            'codigo_barras' => '123456789',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 27,
            'unidad_medida_id' => 1,
            'categoria_id' => 1,
            'marca_id' => 6
        ]);

        Producto::create([
            'image_path' => 'productos/galletacremapozuelo.png',
            'nombreProducto' => 'Galleta CREMA',
            'descripcion' => 'Paquete de Galleta CREMA de Pozuelo con 4 unidades de galleta',
            'codigo_barras' => '1728394655',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 5,
            'unidad_medida_id' => 2,
            'categoria_id' => 3,
            'marca_id' => 8
        ]);
        // Productos aleatorios
        Producto::factory()->count(10)->create();
    }
}
