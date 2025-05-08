<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

<<<<<<<< HEAD:app/Models/Usuario.php
    protected $table = 'usuarios';
    protected $fillable = ['user', 'password', 'empleado_id'];
    protected $hidden = ['password'];

    
    public function getAuthIdentifierName()
    {
        return 'user';
    }
========
    protected $fillable = ['image_path_Usuarios', 'user', 'password', 'empleado_id'];
>>>>>>>> 410f8788e06a8ad6a77ce8901c9e821d053d6f56:app/Models/usuario.php

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}


