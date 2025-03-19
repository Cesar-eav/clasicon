<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLngLatColumns extends Migration
{
    public function up()
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->decimal('lng')->nullable()->change();
            $table->decimal('lat')->nullable()->change();

        
        });
    }

    public function down()
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->decimal('lng', 10, 8)->change();
            $table->decimal('lat', 10, 8)->change();
        });
    }
}
