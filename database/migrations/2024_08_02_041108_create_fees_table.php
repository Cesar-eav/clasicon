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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_honorario');
            $table->date('fecha_honorario');
            $table->string('rut_honorario');
            $table->string('nombre_razon_social_honorario');
            $table->integer('brutos_honorario');
            $table->integer('ret_emision_honorario');
            $table->integer('ret_receptor_honorario');
            $table->boolean('is_ret_receptor')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
