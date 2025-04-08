<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;

    protected $fillable = ['cantidad', 'precio', 'iva', 'descuento', 'subtotal', 'total', 'venta_id', 'producto_id'];

    public function venta()
    {
        return $this->belongsTo(Ventas::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }
}
