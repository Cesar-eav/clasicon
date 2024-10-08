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
        Schema::table('thoughts', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('thoughts')->onDelete('cascade'); // Columna para respuestas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thoughts', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('thoughts')->onDelete('cascade'); // Columna para respuestas
        });
    }
};
