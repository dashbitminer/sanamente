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
        Schema::table('referencia_intervenciones', function (Blueprint $table) {
            $table->boolean('conceptualizacion_problema')
                ->after('id')
                ->nullable()
                ->comment('1:Si, 0:No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('referencia_intervenciones', function (Blueprint $table) {
            $table->dropColumn('conceptualizacion_problema');
        });
    }
};
