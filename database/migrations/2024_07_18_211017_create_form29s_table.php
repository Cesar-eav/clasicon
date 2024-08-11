<?php

use App\Models\Sale;
use App\Models\User;
use App\Models\Company;
use App\Models\Purchase;
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
        Schema::create('form29s', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sale::class)->nullable();
            $table->foreignIdFor(Purchase::class)->nullable();
            $table->foreignIdFor(Company::class);
            $table->foreignIdFor(User::class);
            $table->integer('ppm');
            $table->integer('ppm2');
            $table->integer('retencion_42N1');
            $table->integer('retencion_42N2');
            $table->integer('impuesto_unico_trabajadores')->null();
            $table->integer('impuesto_2da_categoria')->null();
            $table->integer('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form29');
    }
};
