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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->integer('factura_electronica_cantidad_doc')->default(0);
            $table->integer('factura_electronica_exento')->default(0);
            $table->integer('factura_electronica_neto')->default(0);
            $table->integer('factura_electronica_iva')->default(0);

            $table->integer('nota_debito_cantidad_doc')->default(0);
            $table->integer('nota_debito_exento')->default(0);
            $table->integer('nota_debito_neto')->default(0);
            $table->integer('nota_debito_iva')->default(0);

            $table->integer('nota_credito_cantidad_doc')->default(0);
            $table->integer('nota_credito_exento')->default(0);
            $table->integer('nota_credito_neto')->default(0);
            $table->integer('nota_credito_iva')->default(0);

            $table->integer('importaciones_cantidad_doc')->default(0);
            $table->integer('importaciones_exento')->default(0);
            $table->integer('importaciones_neto')->default(0);
            $table->integer('importaciones_iva')->default(0);

            $table->integer('compra_exenta_cantidad_doc')->default(0);
            $table->integer('compra_exenta_exento')->default(0);
            $table->integer('compra_exenta_neto')->default(0);
            $table->integer('compra_exenta_iva')->default(0);

            $table->integer('remanente_cantidad_doc')->default(0);
            $table->integer('remanente_exento')->default(0);
            $table->integer('remanente_neto')->default(0);
            $table->integer('remanente_iva')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
