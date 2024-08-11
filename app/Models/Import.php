<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'dolar_importacion',
        'iva_dolar_importacion',
        'rut_importacion',
        'di_importacion',
        'fecha_importacion',
        'codigo_importacion'
    ];
}
