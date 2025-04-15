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
        Schema::create('formacion_pais_actividad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_actividad_seguimiento_id')->constrained('pais_actividad_seguimientos', 'id', 'fk_pais_actividad_seguimiento_formacion_id');
            $table->foreignId('seguimiento_formacion_general_id')
                ->constrained('seguimiento_formacion_generales', 'id', 'fk_seguimiento_formacion_generales_id');
            $table->timestamp('active_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formacion_pais_actividad');
    }
};
