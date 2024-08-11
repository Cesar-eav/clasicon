<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remuneration extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_imponible_remuneracion',
        'total_no_imponible_remuneracion',
        'total_descuentos_legales_remuneracion',
        'total_descuentos_no_legales_remuneracion',
        'impuesto_unico_trabajadores_remuneracion',
        'retencion_42_n1_remuneracion'
    ];
}
