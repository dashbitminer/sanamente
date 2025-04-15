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
        Schema::create('seguimiento_formacion_generales', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->tinyInteger('participacion')->default(2)->comment('1:Si, 2:No');
            $table->string('codigo_confirmacion')->nullable()->default(null);
            $table->tinyInteger('nacionalidad')->default(1)->comment('1:Nacional, 2:Extranjero');
            $table->string('slug')->unique();

            $table->string('documento_identidad');
            $table->foreignId('pais_id')->constrained('paises', 'id');

            $table->foreignId('pais_perfil_seguimiento_id')->constrained('pais_perfil_seguimientos', 'id', 'fk_pais_perfil_seguimiento_id');

            $table->foreignId('pais_perfil_seguimiento_docente_id')
                ->nullable()
                ->constrained('pais_perfil_seguimiento_docentes', 'id', 'fk_rango_seguimiento_policia_id');

            $table->foreignId('pais_perfil_seguimiento_policia_id')
                ->nullable()
                ->constrained('pais_perfil_seguimiento_policias', 'id', 'fk_pais_perfil_seguimiento_policia_id');

            $table->foreignId('pais_rango_seguimiento_policia_id')
                ->nullable()
                ->constrained('pais_rango_seguimiento_policias', 'id', 'fk_pais_rango_seguimiento_policia_id');

            $table->foreignId('pais_perfil_seguimiento_salud_id')
                ->nullable()
                ->constrained('pais_perfil_seguimiento_salud', 'id', 'fk_pais_perfil_seguimiento_salud_id');

            $table->foreignId('pais_perfil_seguimiento_organizacion_id')
                ->nullable()
                ->constrained('pais_perfil_seguimiento_organizaciones', 'id', 'fk_pais_perfil_organizacion_id');

            $table->foreignId('pais_perfil_seguimiento_hospital_id')
                ->nullable()
                ->constrained('pais_perfil_seguimiento_hospitales', 'id', 'fk_pais_perfil_hospital_id');

            $table->string('escuela_id');
            $table->string('ciudad_id');
            $table->string('departamento_id');

            $table->string('numero_grupo_participa');
            $table->date('fecha_participo_actividad')->nullable()->default(null);
            $table->text('comentario')->nullable()->default(null);
            $table->timestamp('active_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);

            // Add composite index for documento_identidad and pais_id
            $table->index(['documento_identidad', 'pais_id'], 'documento_identidad_pais_id_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimiento_formacion_generales');
    }
};
