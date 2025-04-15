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
        Schema::create('referencia_participantes', function (Blueprint $table) {
            $table->id();

            $table->boolean('inicia_proceso_referencia')->comment('1:Si, 0:No');

            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->tinyInteger('sexo')->nullable();
            $table->date("fecha_nacimiento")->nullable();
            $table->string('documento_identidad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono_familiar')->nullable();
            $table->string('nombre_persona_responsable')->nullable();
            $table->string('documento_identidad_persona_responsable')->nullable();
            $table->string('telefono_persona_responsable')->nullable();

            $table->foreignId('pais_id')->constrained('paises', 'id');

            $table->string('departamento_id')->comment('Datos de Glasswing');
            $table->string('ciudad_id')->comment('Datos de Glasswing');

            $table->foreignId('pais_perfil_participante_id')
                ->nullable()
                ->constrained('pais_perfil_participantes', 'id', 'fk_refpar_pais_perfil_participante_id');

            $table->boolean('posee_discapacidad')->nullable()->comment('1:Si, 0:No');

            $table->foreignId('pais_tipo_discapacidad_id')
                ->nullable()
                ->constrained('pais_tipo_discapacidades', 'id', 'fk_refpar_pais_tipo_discapacidad_id');

            $table->foreignId('pais_otra_condicion_id')
                ->nullable()
                ->constrained('pais_otra_condiciones', 'id', 'fk_refpar_pais_otra_condicion_id');

            $table->string('otras_condiciones_otro')->nullable();

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
        Schema::dropIfExists('referencia_participantes');
    }
};
