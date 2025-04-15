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
        Schema::create('referencia_intervenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('razon_intervencion_id')
                ->nullable()
                ->constrained('razon_intervenciones', 'id');
            $table->string('razon_otro')->nullable();
            // relacion referencias_inmediatas_procesos
            $table->string('proceso_otro')->nullable();
            $table->text('referencia')
                ->nullable()
                ->comment('Adjuntar documento de respaldo de la referencia');
            $table->text('comentario')->nullable();
            $table->datetime('active_at')->nullable();
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
        Schema::dropIfExists('referencia_intervenciones');
    }
};
