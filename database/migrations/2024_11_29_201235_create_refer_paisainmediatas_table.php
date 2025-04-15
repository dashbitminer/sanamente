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
        Schema::create('referencia_pais_accion_inmediatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referencia_id')
                ->nullable()
                ->constrained('referencias', 'id', 'fk_referencia_id');

            $table->foreignId('pais_accion_inmediata_id')
                ->nullable()
                ->constrained('pais_accion_inmediatas', 'id', 'fk_ref_pais_accion_inmediata_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referencia_pais_accion_inmediatas');
    }
};
