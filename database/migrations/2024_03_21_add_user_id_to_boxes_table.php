<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id');
        });

        if (DB::table('boxes')->whereNull('user_id')->exists()) {
            $defaultUserId = DB::table('users')->first()->id ?? 1;
            DB::table('boxes')->whereNull('user_id')->update(['user_id' => $defaultUserId]);
        }

        Schema::table('boxes', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('boxes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}; 