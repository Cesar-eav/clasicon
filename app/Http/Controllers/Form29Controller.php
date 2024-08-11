<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Sale;
use Inertia\Inertia;
use App\Models\Form29;
use App\Models\Import;
use App\Models\Purchase;
use App\Models\Remuneration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Form29Controller extends Controller
{

    public function create()
    {
        return Inertia::render('F29/Create');
    }
    
    public function store(Request $request)
    {   
        Log::info($request);

        DB::transaction(function() use($request){

            $sale = Sale::create([
                'factura_electronica_cantidad_doc' => $request->factura_electronica_cantidad_doc,
                'factura_electronica_exento' => $request->factura_electronica_exento,
                'factura_electronica_neto' => $request->factura_electronica_neto,
                'factura_electronica_iva' => $request->factura_electronica_iva,
    
                'factura_electronica_exenta_cantidad_doc' => $request->factura_electronica_exenta_cantidad_doc,
                'factura_electronica_exenta_exento' => $request->factura_electronica_exenta_exento,
                'factura_electronica_exenta_neto' => $request->factura_electronica_exenta_neto,
                'factura_electronica_exenta_iva' => $request->factura_electronica_exenta_iva,
    
                'boleta_electronica_cantidad_doc' => $request->boleta_electronica_cantidad_doc,
                'boleta_electronica_exento' => $request->boleta_electronica_exento,
                'boleta_electronica_neto' => $request->boleta_electronica_neto,
                'boleta_electronica_iva' => $request->boleta_electronica_iva,
    
                'comprobante_medios_electronicos_cantidad_doc' => $request->comprobante_medios_electronicos_cantidad_doc,
                'comprobante_medios_electronicos_exento' => $request->comprobante_medios_electronicos_exento,
                'comprobante_medios_electronicos_neto' => $request->comprobante_medios_electronicos_neto,
                'comprobante_medios_electronicos_iva' => $request->comprobante_medios_electronicos_iva,
    
                'nota_debito_cantidad_doc' => $request->nota_debito_cantidad_doc,
                'nota_debito_exento' => $request->nota_debito_exento,
                'nota_debito_neto' => $request->nota_debito_neto,
                'nota_debito_iva' => $request->nota_debito_iva,
    
                'nota_credito_cantidad_doc' => $request->nota_credito_cantidad_doc,
                'nota_credito_exento' => $request->nota_credito_exento,
                'nota_credito_neto' => $request->nota_credito_exento,
                'nota_credito_iva' => $request->nota_credito_iva,
    
                'facturas_retencion_cantidad_doc' => $request->facturas_retencion_cantidad_doc,
                'facturas_retencion_exento' => $request->facturas_retencion_exento,
                'facturas_retencion_neto' => $request->facturas_retencion_neto,
                'facturas_retencion_iva' => $request->facturas_retencion_iva
            ]);

            $purchase = Purchase::create([
                'factura_electronica_cantidad_doc' => $request->factura_electronica_cantidad_doc,
                'factura_electronica_exento' => $request->factura_electronica_exento,
                'factura_electronica_neto' => $request->factura_electronica_neto,
                'factura_electronica_iva' => $request->factura_electronica_iva,
    
                'nota_debito_cantidad_doc' => $request->nota_debito_cantidad_doc,
                'nota_debito_exento' => $request->nota_debito_exento,
                'nota_debito_neto' => $request->nota_debito_neto,
                'nota_debito_iva' => $request->nota_debito_iva,
    
                'nota_credito_cantidad_doc' => $request->nota_credito_cantidad_doc,
                'nota_credito_exento' => $request->nota_credito_exento,
                'nota_credito_neto' => $request->nota_credito_neto,
                'nota_credito_iva' => $request->nota_credito_iva,
    
                'importaciones_cantidad_doc' => $request->importaciones_cantidad_doc,
                'importaciones_exento' => $request->importaciones_exento,
                'importaciones_neto' => $request->importaciones_neto,
                'importaciones_iva' => $request->importaciones_iva,
    
                'compra_exenta_cantidad_doc' => $request->compra_exenta_cantidad_doc,
                'compra_exenta_exento' => $request->compra_exenta_exento,
                'compra_exenta_neto' => $request->compra_exenta_neto,
                'compra_exenta_iva' => $request->compra_exenta_iva,
    
                'remanente_cantidad_doc' => $request->remanente_cantidad_doc,
                'remanente_exento' => $request->remanente_exento,
                'remanente_neto' => $request->remanente_neto,
                'remanente_iva' => $request->remanente_iva
            ]);

            $import = Import::create([
                'dolar_importacion' => $request->dolar_importacion,
                'iva_dolar_importacion' => $request->iva_dolar_importacion,
                'rut_importacion' => $request->rut_importacion,
                'di_importacion' => $request->di_importacion,
                'fecha_importacion' => $request->fecha_importacion,
                'codigo_importacion' => $request->codigo_importacion 
            ]);

            $remuneration = Remuneration::create([
                'total_imponible_remuneracion' => $request->total_imponible_remuneracion,
                'total_no_imponible_remuneracion' => $request->total_no_imponible_remuneracion,
                'total_descuentos_legales_remuneracion' => $request->total_descuentos_legales_remuneracion,
                'total_descuentos_no_legales_remuneracion' => $request->total_descuentos_no_legales_remuneracion,
                'impuesto_unico_trabajadores_remuneracion' => $request->impuesto_unico_trabajadores_remuneracion,
                'retencion_42_n1_remuneracion' => $request->retencion_42_n1_remuneracion
            ]);

            foreach($request->rows as $fee){
                $fee = Fee::create([
                    'numero_honorario' => $fee['numero_honorario'],
                    'fecha_honorario' => $fee['fecha_honorario'],
                    'rut_honorario' => $fee['rut_honorario'],
                    'nombre_razon_social_honorario' => $fee['nombre_razon_social_honorario'],
                    'brutos_honorario' => $fee['brutos_honorario'],
                    'ret_emision_honorario' => $fee['ret_emision_honorario'] ?? 0,
                    'ret_receptor_honorario' => $fee['ret_receptor_honorario'] ?? 0,
                    'is_ret_receptor' => $fee['isRetReceptor']
                ]);
            }
            
            Form29::create([
                'user_id' => auth()->user()->id,
                'purchase_id' => $purchase->id,
                'sale_id' => $sale->id,
                'company_id' => $request->company_id,
                'import_id' => $import->id,
                'remuneration_id' => $remuneration->id,
                'ppm' => $request->ppm,
                'ppm2' => $request->ppm2,
                'retencion_42N1' => $request->retencion_42N1,
                'retencion_42N2' => $request->retencion_42N2,
                'impuesto_unico_trabajadores' => $request->impuesto_unico_trabajadores,
                'impuesto_2da_categoria' => $request->impuesto_2da_categoria,
                'total_amount' => $request->total_amount
            ]);

        });
    }

    public function show()
    {
        $form29s = Form29::with('purchase','sale','company')->paginate(5);
        return Inertia::render('F29/Show',[
            'form29s' => $form29s
        ]);
    }

    public function listForm29()
    {
        return Form29::with('purchase','sale','company','import','remuneration','fee')->get();
    }
}
