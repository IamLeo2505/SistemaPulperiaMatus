<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad', 'precio', 'iva', 'descuento', 'subtotal', 'total', 'compra_id', 'producto_id'];

    public function compra()
    {
        return $this->belongsTo(Compras::class, 'compra_id');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}

