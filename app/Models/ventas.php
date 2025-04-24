<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $fillable = ['nventa', 'subtotal', 'descuento', 'iva', 'total', 'tiempo_id', 'empleado_id', 'cliente_id'];

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id');
    }

    public function tiempo()
    {
        return $this->hasMany(Tiempo::class, 'tiempo_id');
    }
}
