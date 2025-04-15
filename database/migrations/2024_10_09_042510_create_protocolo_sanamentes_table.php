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
        Schema::create('protocolo_sanamentes', function (Blueprint $table) {
            $table->id();
            // relacion sanamente_tipo_psicoeducaciones
            // relacion sanamente_estrategias
            $table->boolean('pauso_protocolo')->nullable()->comment('1:Si, 0:No');
            $table->foreignId('pauso_protocolo_id')
                ->nullable()
                ->constrained('pauso_protocolos', 'id', 'fk_pauso_protocolo_id')
                ->comment('Porque se pauso el protocolo?');
            $table->string('pauso_protocolo_otros')->nullable();
            $table->text('consentimiento')
                ->nullable()
                ->comment('Adjunte el consentimiento informado de la persona participante');
            $table->text('comentario')->nullable()->comment('Comentarios adicionales');
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
        Schema::dropIfExists('protocolo_sanamentes');
    }
};
