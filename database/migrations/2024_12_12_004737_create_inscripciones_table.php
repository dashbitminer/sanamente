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
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->date("fecha_nacimiento")->nullable();
            $table->foreignId('institucion_organizacion_id')
                ->nullable()
                ->constrained('institucion_organizaciones', 'id', 'fk_inscripciones_institucion_organizaciones');

            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->tinyInteger('sexo')->nullable()->comment('1:Hombre, 2:Mujer');
            $table->foreignId('pais_id')->constrained('paises', 'id');
            $table->string('departamento_id')->nullable()->comment('Datos de Glasswing');
            $table->string('ciudad_id')->nullable()->comment('Datos de Glasswing');
            $table->boolean('nacionalidad')->nullable()->comment('1:Nacional, 0:Extranjero');
            $table->string('documento_identidad')->nullable();
            $table->string('telefono')->nullable()->nullable();
            $table->string('email')->nullable()->nullable();
            $table->tinyInteger('estudiando')->nullable()->comment('1:Si, 2: No');
            $table->foreignId('grado_id')->nullable();
            $table->foreignId('grado_seccion_id')->nullable();
            $table->foreignId('grado_jornada_id')->nullable();
            $table->foreignId('grado_alcanzado_id')->nullable();
            $table->tinyInteger('discapacidad')->nullable()->comment('1:Si, 2:No');
            // $table->foreignId('inscripcion_discapacidad_id')
            //     ->nullable()
            //     ->constrained('inscripcion_discapacidades', 'id', 'fk_inscripciones_inscripcion_discapacidad');
            $table->tinyInteger('ha_participado_actividades_glasswing')->nullable()->comment('1:Si, 2:No');
            $table->string('perfil_identificas')->nullable();
            $table->foreignId('perfil_institucional_id')->nullable();
            $table->foreignId('perfil_institucional_educacion_id')->nullable();
            $table->foreignId('perfil_institucional_policia_id')->nullable();
            $table->foreignId('perfil_rango_id')->nullable();
            $table->foreignId('perfil_rango_organizacion_id')->nullable();
            $table->foreignId('perfil_rango_salud_id')->nullable();
            $table->foreignId('perfil_personal_salud_id')->nullable();
            $table->string('pertenece_departamento_id')->nullable()->comment('Datos de Glasswing');
            $table->string('pertenece_ciudad_id')->nullable()->comment('Datos de Glasswing');
            $table->string('pertenece_sede_id')->nullable()->comment('Datos de Glasswing');

            $table->string('centro_educativo')->nullable();
            $table->foreignId('centro_educativo_tipo_id')
                ->nullable()
                ->constrained('centro_educativo_tipos', 'id', 'fk_inscripciones_centro_educativo_tipos');
            $table->foreignId('centro_educativo_cargo_id')
                ->nullable()
                ->constrained('centro_educativo_cargos', 'id', 'fk_inscripciones_centro_educativo_cargos');
            $table->string('labora_departamento_id')->nullable()->comment('Datos de Glasswing');
            $table->string('labora_municipio_id')->nullable()->comment('Datos de Glasswing');
            $table->string('labora_aldea_id')->nullable()->comment('Datos de Glasswing');
            $table->string('labora_caserio_id')->nullable()->comment('Datos de Glasswing');
            $table->string('labora_codigo_sace')->nullable()->comment('Datos de Glasswing');
            $table->tinyInteger('centro_educativo_jornada')->nullable()->comment('1:Matutina, 2:Vespertina, 3:Nocturna');
            $table->foreignId('centro_educativo_nivel_id')
                ->nullable()
                ->constrained('centro_educativo_niveles', 'id', 'fk_inscripciones_centro_educativo_niveles');
            $table->foreignId('centro_educativo_ciclo_id')
                ->nullable()
                ->constrained('centro_educativo_ciclos', 'id', 'fk_inscripciones_centro_educativo_ciclos');
            $table->tinyInteger('centro_educativo_zona_geografica')->nullable()->comment('1:Urbana, 2:Rural');

            $table->tinyInteger('autorizacion_informacion')->nullable()->comment('1:Si, 2:No');
            $table->tinyInteger('derechos_image_voz')->nullable()->comment('1:Brindo autorización de mi voz e imagen, 2: No brindo autorización de mi voz e imagen');
            $table->tinyInteger('consentimiento')->nullable()->comment('1:Si, 2:No');

            $table->string('codigo_confirmacion')->nullable()->default(null);
            $table->text('comentario')->nullable()->default(null);
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id', 'fk_inscripciones_user_id');
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
        Schema::dropIfExists('inscripciones');
    }
};
