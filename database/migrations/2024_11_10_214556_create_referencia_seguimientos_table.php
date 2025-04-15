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
        Schema::create('referencia_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('referencia_id')
                ->constrained('referencias', 'id', 'fk_referencias');

            $table->boolean('ha_recibido_servicio')->comment('1:Si, 0:No');
            $table->text('descripcion')->nullable()->default(null);

            $table->foreignId('pais_seguimiento_detalle_id')
                ->nullable()
                ->constrained('pais_seguimiento_detalles', 'id', 'fk_pais_seguimiento_detalle_id');

            $table->foreignId('pais_seguimiento_paso_id')
                ->nullable()
                ->constrained('pais_seguimiento_pasos', 'id', 'fk_pais_seguimiento_paso_id');

            $table->boolean('solicita_otra_referencia')->comment('1:Si, 0:No');

            $table->text('comentario')->nullable()->default(null);
            
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
        Schema::dropIfExists('referencia_seguimientos');
    }
};
