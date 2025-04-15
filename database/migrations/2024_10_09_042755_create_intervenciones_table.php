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
        Schema::create('intervenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervencion_participante_id')
                ->nullable()
                ->constrained('intervencion_participantes', 'id', 'fk_intervencion_participantes_intervencion_participante_id');
            $table->boolean('primera_intervencion')->comment('1:Si, 0:No');
            $table->boolean('compartir_informacion')->comment('1:Si, 0:No');
            // @deprecated se va a reemplazar perfil_participante_id por "perfil_participante" de tipo json para guardar multiples valores
            $table->foreignId('perfil_participante_id')->constrained('perfil_participantes');
            $table->foreignId('pais_id')->constrained('paises', 'id');
            $table->string('departamento_id')->comment('Datos de Glasswing');
            $table->string('ciudad_id')->comment('Datos de Glasswing');
            $table->string('sede_id')->comment('Datos de Glasswing');
            $table->date("fecha_intervencion")->nullable();
            $table->time('inicio_intervencion')->nullable();
            $table->time('fin_intervencion')->nullable();
            $table->time('pauso_intervencion')->nullable();
            $table->string('total_intervencion')
                ->nullable()
                ->default(null)
                ->comment('Calcular como obtener en formato H:m');
            // relationship to intervencion_tipo_otra_intervencion table
            $table->boolean('persona_referida')->nullable()->comment('1:Si, 0:No');
            $table->foreignId('protocolo_sanamente_id')
                ->nullable()
                ->constrained('protocolo_sanamentes', 'id', 'fk_protocolo_sanamentes_protocolo_sanamente_id');
            $table->foreignId('primer_auxilio_psicologico_id')
                ->nullable()
                ->constrained('primeros_auxilios_psicologicos', 'id', 'fk_primer_auxilio_psicologico_id');
            $table->foreignId('referencia_intervencion_id')
                ->nullable()
                ->constrained('referencia_intervenciones', 'id');
            $table->boolean('participar_proceso_evaluacion')->nullable()->comment('1:Si, 0:No');
            $table->string('codigo_confirmacion')->nullable()->default(null);
            $table->text('comentario')->nullable()->default(null);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id', 'fk_intervencion_user_id');
            $table->datetime('active_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);

            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervenciones');
    }
};
