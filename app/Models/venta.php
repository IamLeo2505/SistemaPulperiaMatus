<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nventa',
        'fecha',
        'subtotal',
        'descuento',
        'iva',
        'total',
        'empleado_id',
        'cliente_id'];

    /*public function tiempo()
    {
        return $this->belongsTo(Tiempo::class, 'tiempo_id');
    }*/

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
