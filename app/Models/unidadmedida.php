<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_unidad'];

    public function productos()
    {
        return $this->hasMany(Productos::class, 'unidad_medida_id');
    }
}
