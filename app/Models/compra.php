<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['ncompra', 'fecha', 'subtotal', 'descuento', 'iva', 'total', 'empleado_id', 'proveedor_id', 'usuario_id',];

    // public function tiempo()
    // {
    //     return $this->belongsTo(Tiempo::class, 'tiempo_id');
    // }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function detalles()
{
    return $this->hasMany(DetalleCompra::class, 'compra_id');
}

    public function usuario()
{
    return $this->belongsTo(Usuario::class, 'usuario_id');
}


}
