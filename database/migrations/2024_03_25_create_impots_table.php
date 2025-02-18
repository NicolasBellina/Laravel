<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('impots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('annee');
            $table->decimal('montant_total', 10, 2)->comment('Montant total des revenus');
            $table->string('regime')->default('micro-foncier')->comment('micro-foncier ou reel');
            $table->string('case_declaration')->comment('4 BE (2042) pour micro-foncier, 4 BA (2044) pour réel');
            $table->decimal('montant_imposable', 10, 2)->comment('70% du montant total pour micro-foncier, 100% pour réel');
            $table->boolean('regime_reel_obligatoire')->default(false)->comment('True si montant > 15000€');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('impots');
    }
}; 