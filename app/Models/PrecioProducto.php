<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'preciocompra',
        'precioventa',
        'impuesto_iva',
        'productos_id',
        'unidad_medida_id',
        'categoria_id',
        'inventario_id',
        'proveedor_id'

    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class);
    }

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class);
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
