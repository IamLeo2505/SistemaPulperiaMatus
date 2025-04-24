<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad', 'precio', 'iva', 'descuento', 'subtotal', 'total', 'compras_id', 'productos_id', 'unidad_medida_id', 'inventario_id', 'categoria_id', 'proveedor_id'];

    public function compra()
    {
        return $this->belongsTo(Compras::class, 'compra_id');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'unidad_medida_id');
    }
    public function unidad_medida()
    {
        return $this->belongsTo(UnidadMedida::class, 'proveeedor_id');
    }
    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'inventario_id');
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}

