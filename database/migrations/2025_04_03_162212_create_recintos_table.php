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
        Schema::create('recintos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recommendation_id')->constrained('recommendations')->onDelete('cascade');
            $table->string('opening_hours')->nullable();
            $table->decimal('entry_fee', 8, 2)->nullable();
            $table->string('type'); // Museo, teatro, estadio, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recintos', function (Blueprint $table) {
            //
        });
    }
};
