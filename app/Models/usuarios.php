<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['user', 'password', 'empleado_id'];

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'empleado_id');
    }
}
