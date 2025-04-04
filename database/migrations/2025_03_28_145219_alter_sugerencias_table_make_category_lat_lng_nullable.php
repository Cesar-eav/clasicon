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
        Schema::table('sugerencias', function (Blueprint $table) {
            $table->string('category')->nullable()->change();
            $table->string('lat')->nullable()->change();
            $table->string('lng')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sugerencias', function (Blueprint $table) {
            $table->string('category')->nullable(false)->change();
            $table->string('lat')->nullable(false)->change();
            $table->string('lng')->nullable(false)->change();
        });
    }
};
