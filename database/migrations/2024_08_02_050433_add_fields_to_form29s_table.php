<?php

use App\Models\Fee;
use App\Models\Import;
use App\Models\Remuneration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('form29s', function (Blueprint $table) {
            $table->foreignIdFor(Import::class)->nullable();
            $table->foreignIdFor(Fee::class)->nullable();
            $table->foreignIdFor(Remuneration::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form29s', function (Blueprint $table) {
            //
        });
    }
};
