<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_electronica_cantidad_doc',
        'factura_electronica_exento',
        'factura_electronica_neto',
        'factura_electronica_iva',
        'factura_electronica_exenta_cantidad_doc',
        'factura_electronica_exenta_exento',
        'factura_electronica_exenta_neto',
        'factura_electronica_exenta_iva',
        'boleta_electronica_cantidad_doc',
        'boleta_electronica_exento',
        'boleta_electronica_neto',
        'boleta_electronica_iva',
        'comprobante_medios_electronicos_cantidad_doc',
        'comprobante_medios_electronicos_exento',
        'comprobante_medios_electronicos_neto',
        'comprobante_medios_electronicos_iva',
        'nota_debito_cantidad_doc',
        'nota_debito_exento',
        'nota_debito_neto',
        'nota_debito_iva',
        'nota_credito_cantidad_doc',
        'nota_credito_exento',
        'nota_credito_neto',
        'nota_credito_iva',
        'facturas_retencion_cantidad_doc',
        'facturas_retencion_exento',
        'facturas_retencion_neto',
        'facturas_retencion_iva'
    ];
}
