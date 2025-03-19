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
        Schema::table('recommendations', function (Blueprint $table) {
            $table->string('ciudad')->nullable();
            $table->string('enlace')->nullable();
            $table->string('autor')->nullable();
            $table->decimal('lng', 10, 8)->nullable();
            $table->decimal('lat', 10, 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->dropColumn('ciudad');
            $table->dropColumn('lng');
            $table->dropColumn('lat');
        });
    }
};
