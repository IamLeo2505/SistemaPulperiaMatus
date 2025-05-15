<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
    'user',
    'password',
    'empleado_id',
    'image_path_Usuarios'];

    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'user';
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}
