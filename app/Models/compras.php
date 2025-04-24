<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = ['ncompra', 'subtotal', 'descuento', 'iva', 'total', 'tiempo_id', 'empleado_id', 'proveedor_id'];

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function empleados()
    {
        return $this->hasMany(Empleados::class, 'empleado_id');
    }
}
