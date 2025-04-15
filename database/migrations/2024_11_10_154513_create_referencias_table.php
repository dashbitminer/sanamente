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
        Schema::create('referencias', function (Blueprint $table) {
            $table->id();

            $table->foreignId('referencia_participante_id')
                ->nullable()
                ->constrained('referencia_participantes', 'id', 'fk_referencia_participantes_id');

            $table->date("fecha_registro")->nullable();

            $table->foreignId('pais_accion_inmediata_id')
                ->nullable()
                ->constrained('pais_accion_inmediatas', 'id', 'fk_refpar_pais_accion_inmediata_id');

            $table->string('accion_inmediata_otro')->nullable();
            
            $table->foreignId('pais_motivo_referencia_id')
                ->nullable()
                ->constrained('pais_motivo_referencias', 'id', 'fk_refpar_pais_motivo_referencia_id'); 
                
            $table->foreignId('pais_tipo_violencia_id')
                ->nullable()
                ->constrained('pais_tipo_violencias', 'id', 'fk_refpar_pais_tipo_violencia_id'); 
            
            $table->string('motivo_referencia_otro')->nullable();

            $table->text('comentario')->nullable()->default(null);

            $table->boolean('activacion_protocolos')->nullable()->comment('1:Si, 0:No');

            $table->string('documento_protocolos')->nullable();

            $table->foreignId('pais_tipo_servicio_id')
                ->nullable()
                ->constrained('pais_tipo_servicios', 'id', 'fk_refpar_pais_tipo_servicio_id');
            
            $table->foreignId('pais_salud_mental_servicio_id')
                ->nullable()
                ->constrained('pais_salud_mental_servicios', 'id', 'fk_refpar_pais_salud_mental_servicio_id');
            
            $table->string('tipo_servicio_otro')->nullable();
            
            $table->foreignId('pais_institucion_referencia_id')
                ->nullable()
                ->constrained('pais_institucion_referencias', 'id', 'fk_refpar_pais_institucion_referencia_id');

            $table->string('nombre_otra_institucion')->nullable();

            $table->foreignId('pais_urgencia_referencia_parametro_id')
                ->nullable()
                ->constrained('pais_urgencia_referencia_parametros', 'id', 'fk_refpar_pais_urgencia_referencia_parametro_id');

            $table->foreignId('pais_modalidad_consentimiento_id')
                ->nullable()
                ->constrained('pais_modalidad_consentimientos', 'id', 'fk_refpar_pais_modalidad_consentimiento_id');
            
            $table->string('documento_consentimientos')->nullable();

            $table->boolean('autorizacion_persona_adulta')->nullable()->comment('1:Si, 0:No');

            $table->string('documento_autorizacion_persona_adulta')->nullable();

            $table->boolean('acepta_referencia')->nullable()->comment('1:Si, 0:No');

            $table->boolean('autoriza_adulto')->nullable()->comment('1:Si, 0:No');

            /// campos para quienes no aceptan la referencia

            $table->foreignId('pais_origen_referencia_id')
                ->nullable()
                ->constrained('pais_origen_referencias', 'id', 'fk_refpar_pais_origen_referencia_id');
            
            $table->tinyInteger('sexo_persona_contacta')->nullable();
            $table->date("fecha_recibe_referencia")->nullable();

            $table->foreignId('pais_no_acepta_referencia_razon_id')
            ->nullable()
            ->constrained('pais_no_acepta_referencia_razones', 'id', 'fk_refpar_pais_no_acepta_referencia_razon_id');

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
        Schema::dropIfExists('referencias');
    }
};
