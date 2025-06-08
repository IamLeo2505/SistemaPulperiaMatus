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
            'image_path' => 'n/a',
            'nombreProducto' => 'Coca Cola 3L',
            'descripcion' => 'Refresco',
            'codigo_barras' => '123456789',
            'cantidadstock' => 10,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 75,
            'unidad_medida_id' => 1,
            'categoria_id' => 19,
            'marca_id' => 2
        ]);

        Producto::create([
            'image_path' => 'n/a',
            'nombreProducto' => 'Huevo',
            'descripcion' => 'n/a',
            'codigo_barras' => '987654321',
            'cantidadstock' => 300,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 6,
            'unidad_medida_id' => 2,
            'categoria_id' => 22,
            'marca_id' => 3
        ]);
        
        Producto::create([
            'image_path' => 'Oreo.jpg',
            'nombreProducto' => 'Oreo',
            'descripcion' => 'Galleta',
            'codigo_barras' => '1928374655',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 10,
            'unidad_medida_id' => 2,
            'categoria_id' => 20,
            'marca_id' => 9
        ]);

        Producto::create([
            'image_path' => 'productos/pepsi360ml.png',
            'nombreProducto' => 'Avena',
            'descripcion' => 'Avena granulada',
            'codigo_barras' => '5546372819',
            'cantidadstock' => 20,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 37,
            'unidad_medida_id' => 3,
            'categoria_id' => 9,
            'marca_id' => 10
        ]);

        Producto::create([
            'image_path' => 'LecheEskimo.jpg',
            'nombreProducto' => 'Leche Eskimo ',
            'descripcion' => 'Leche',
            'codigo_barras' => '123456789',
            'cantidadstock' => 25,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 44,
            'unidad_medida_id' => 1,
            'categoria_id' => 2,
            'marca_id' => 11
        ]);

        Producto::create([
            'image_path' => 'Maruchan.jpg',
            'nombreProducto' => 'Maruchan Vaso',
            'descripcion' => 'Ramen instantáneo',
            'codigo_barras' => '1728394655',
            'cantidadstock' => 50,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 40,
            'unidad_medida_id' => 2,
            'categoria_id' => 4,
            'marca_id' => 12
        ]);
        Producto::create([
            'image_path' => 'Raptor.jpg',
            'nombreProducto' => 'Raptor 600ml',
            'descripcion' => 'Bebida energizante',
            'codigo_barras' => '984648654',
            'cantidadstock' => 20,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 36,
            'unidad_medida_id' => 2,
            'categoria_id' => 1,
            'marca_id' => 22
        ]);
        Producto::create([
            'image_path' => 'AceiteMazola.jpg',
            'nombreProducto' => 'Aceite Mazola',
            'descripcion' => 'Aceite de cocina',
            'codigo_barras' => '88949561',
            'cantidadstock' => 10,
            'fechavencimiento' => now()->addMonths(6),
            'precio_producto' => 86,
            'unidad_medida_id' => 2,
            'categoria_id' => 24,
            'marca_id' => 20
        ]);
        Producto::create([
            'image_path' => 'KotexNocturna.jpg',
            'nombreProducto' => 'Kotex Nocturna',
            'descripcion' => 'Toalla Sanitaria',
            'codigo_barras' => '1459846165',
            'cantidadstock' => 20,
            'fechavencimiento' => now()->addMonths(12),
            'precio_producto' => 62,
            'unidad_medida_id' => 2,
            'categoria_id' => 7,
            'marca_id' => 21
        ]);
        Producto::create([
            'image_path' => 'azucar.jpg',
            'nombreProducto' => 'Azúcar',
            'descripcion' => 'Edulcorante utilizado para endulzar los alimentos',
            'codigo_barras' => '12165498',
            'cantidadstock' => 1,
            'fechavencimiento' => now()->addMonths(12),
            'precio_producto' => 17,
            'unidad_medida_id' => 3,
            'categoria_id' => 9,
            'marca_id' => 13
        ]);
        Producto::create([
            'image_path' => 'Pegablanca.jpg',
            'nombreProducto' => 'Pega Blanca',
            'descripcion' => 'Pegamento escolar',
            'codigo_barras' => '265941661',
            'cantidadstock' => 10,
            'fechavencimiento' => now()->addMonths(8),
            'precio_producto' => 20,
            'unidad_medida_id' => 2,
            'categoria_id' => 25,
            'marca_id' => 13
        ]);
        Producto::create([
            'image_path' => 'SardinasLaSirena.jpg',
            'nombreProducto' => 'Sardinas La Sirena',
            'descripcion' => 'Sardinas enlatadas',
            'codigo_barras' => '12354697',
            'cantidadstock' => 10,
            'fechavencimiento' => now()->addMonths(12),
            'precio_producto' => 48,
            'unidad_medida_id' => 2,
            'categoria_id' => 16,
            'marca_id' => 18
        ]);
        /* Productos aleatorios
        Producto::factory()->count(10)->create();*/
    }
}
