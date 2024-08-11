<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_electronica_cantidad_doc' ,
        'factura_electronica_exento',
        'factura_electronica_neto',
        'factura_electronica_iva',
        'nota_debito_cantidad_doc',
        'nota_debito_exento',
        'nota_debito_neto',
        'nota_debito_iva',
        'nota_credito_cantidad_doc',
        'nota_credito_exento',
        'nota_credito_neto',
        'nota_credito_iva',
        'importaciones_cantidad_doc',
        'importaciones_exento',
        'importaciones_neto',
        'importaciones_iva',
        'compra_exenta_cantidad_doc',
        'compra_exenta_exento',
        'compra_exenta_neto',
        'compra_exenta_iva',
        'remanente_cantidad_doc',
        'remanente_exento',
        'remanente_neto',
        'remanente_iva'
    ];
}
