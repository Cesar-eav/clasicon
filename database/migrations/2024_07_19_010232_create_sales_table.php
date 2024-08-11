<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->integer('factura_electronica_cantidad_doc')->default(0);
            $table->integer('factura_electronica_exento')->default(0);
            $table->integer('factura_electronica_neto')->default(0);
            $table->integer('factura_electronica_iva')->default(0);

            $table->integer('factura_electronica_exenta_cantidad_doc')->default(0);
            $table->integer('factura_electronica_exenta_exento')->default(0);
            $table->integer('factura_electronica_exenta_neto')->default(0);
            $table->integer('factura_electronica_exenta_iva')->default(0);

            $table->integer('boleta_electronica_cantidad_doc')->default(0);
            $table->integer('boleta_electronica_exento')->default(0);
            $table->integer('boleta_electronica_neto')->default(0);
            $table->integer('boleta_electronica_iva')->default(0);

            $table->integer('comprobante_medios_electronicos_cantidad_doc')->default(0);
            $table->integer('comprobante_medios_electronicos_exento')->default(0);
            $table->integer('comprobante_medios_electronicos_neto')->default(0);
            $table->integer('comprobante_medios_electronicos_iva')->default(0);

            $table->integer('nota_debito_cantidad_doc')->default(0);
            $table->integer('nota_debito_exento')->default(0);
            $table->integer('nota_debito_neto')->default(0);
            $table->integer('nota_debito_iva')->default(0);

            $table->integer('nota_credito_cantidad_doc')->default(0);
            $table->integer('nota_credito_exento')->default(0);
            $table->integer('nota_credito_neto')->default(0);
            $table->integer('nota_credito_iva')->default(0);

            $table->integer('facturas_retencion_cantidad_doc')->default(0);
            $table->integer('facturas_retencion_exento')->default(0);
            $table->integer('facturas_retencion_neto')->default(0);
            $table->integer('facturas_retencion_iva')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
