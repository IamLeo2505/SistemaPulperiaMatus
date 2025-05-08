<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombreEmpleado', 'apellidoEmpleado', 'correoEmpleado', 'direccionEmpleado'];

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'empleado_id');
    }
}
