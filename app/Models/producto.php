<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    protected $fillable = ['image_path', 'nombreProducto', 'descripcion', 'codigo_barras', 'cantidadstock', 'fechavencimiento', 'precio_producto', 'unidad_medida_id', 'categoria_id', 'marca_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function unidad_medida()
    {
        return $this->belongsTo(Unidad_Medida::class, 'unidad_medida_id');
    }

}
