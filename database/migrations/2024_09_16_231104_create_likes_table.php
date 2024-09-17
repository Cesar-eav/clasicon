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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario que da el "me gusta"
            $table->foreignId('recommendation_id')->constrained()->onDelete('cascade'); // El post que recibe el "me gusta"
            $table->timestamps();
        
            // Evitar duplicados (un usuario solo puede dar un "me gusta" a un post una vez)
            $table->unique(['user_id', 'recommendation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
