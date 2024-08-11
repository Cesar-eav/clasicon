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
        Schema::create('remunerations', function (Blueprint $table) {
            $table->id();
            $table->integer('total_imponible_remuneracion');
            $table->integer('total_no_imponible_remuneracion');
            $table->integer('total_descuentos_legales_remuneracion');
            $table->integer('total_descuentos_no_legales_remuneracion');
            $table->integer('impuesto_unico_trabajadores_remuneracion');
            $table->integer('retencion_42_n1_remuneracion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remunerations');
    }
};
