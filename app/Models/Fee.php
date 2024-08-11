<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_honorario',
        'fecha_honorario',
        'rut_honorario',
        'nombre_razon_social_honorario',
        'brutos_honorario',
        'ret_emision_honorario',
        'ret_receptor_honorario',
        'is_ret_receptor'
    ];
}
