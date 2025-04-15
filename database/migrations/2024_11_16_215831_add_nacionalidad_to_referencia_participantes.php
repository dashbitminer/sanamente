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
        Schema::table('referencia_participantes', function (Blueprint $table) {
            $table->boolean('nacionalidad')->comment('1:Nacional, 0:Extranjero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('referencia_participantes', function (Blueprint $table) {
            //
        });
    }
};
