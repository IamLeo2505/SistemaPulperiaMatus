<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'telefono', 'direccion'];

    public function usuario()
    {
        return $this->hasOne(Usuarios::class, 'empleado_id');
    }
}
