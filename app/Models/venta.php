<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['nventa', 'subtotal', 'descuento', 'iva', 'total', 'tiempo_id', 'empleado_id', 'cliente_id'];

    public function tiempo()
    {
        return $this->belongsTo(Tiempo::class, 'tiempo_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function cliente()
    {
        return $this->hasMany(Cliente::class, 'cliente_id');
    }
}
