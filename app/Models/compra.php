<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['ncompra', 'subtotal', 'descuento', 'iva', 'total', 'tiempo_id', 'empleado_id', 'proveedor_id'];

    public function tiempo()
    {
        return $this->belongsTo(Tiempo::class, 'tiempo_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function proveedor()
    {
        return $this->hasMany(Proveedor::class, 'proveedor_id');
    }
}
