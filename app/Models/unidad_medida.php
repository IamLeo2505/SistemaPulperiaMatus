<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad_Medida extends Model
{
    use HasFactory;

    protected $table = 'unidades_medidas';

    protected $fillable = ['nombre_unidad'];

}
