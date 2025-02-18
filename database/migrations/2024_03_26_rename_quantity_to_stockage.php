<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->renameColumn('quantity', 'stockage');
        });
    }

    public function down()
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->renameColumn('stockage', 'quantity');
        });
    }
}; 