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
        Schema::create('referencia_pais_tipo_violencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referencia_id')
                ->nullable()
                ->constrained('referencias', 'id', 'fk_ref_pais_tipo_vio_id');

            $table->foreignId('pais_tipo_violencia_id')
                ->nullable()
                ->constrained('pais_tipo_violencias', 'id', 'fk_ref_pais_tipo_violencia_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referencia_pais_motivo_violencia');
    }
};
