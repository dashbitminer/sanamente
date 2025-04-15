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
        Schema::create('club_nnas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_confirmacion')->nullable()->default(null);
            $table->foreignId('pais_id')->constrained('paises', 'id');

            $table->boolean('autorizacion_participacion')->nullable();
            $table->boolean('autorizacion_datos_personales')->nullable();
            $table->boolean('autorizacion_voz_image')->nullable();
            $table->boolean('autorizacion_consentimiento')->nullable();

            $table->string('nombres_responsable')->nullable();
            $table->smallInteger('parentesco_gwdata_id')->nullable();
            $table->string('telefono')->nullable();
            $table->string('documento_identidad')->nullable();

            $table->boolean('confirmo_copia_documento')->nullable();
            $table->boolean('informado_sobre_nna')->nullable();
            $table->boolean('nna_ha_escuchado')->nullable();
            $table->boolean('leido_comprendido')->nullable();
            $table->boolean('deseo_participar')->nullable();
            $table->boolean('uso_recoleccion_datos')->nullable();
            $table->boolean('uso_imagen')->nullable();
            $table->boolean('autorizacion_nna')->nullable();

            $table->boolean('nacionalidad')->nullable()->comment('1:Nacional, 0:Extranjero');
            $table->boolean('ha_participado_anteriormente')->nullable()->comment('1:Si, 2:No');
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->smallInteger('sexo')->nullable()->comment('1: Mujer, 2: Hombre');
            $table->boolean('encuentras_estudiando')->default(false);

            $table->smallInteger('ultimo_grado_alcanzado_gwdata_id')->nullable();

            $table->tinyInteger('posee_discapacidad')->nullable()->comment('1:Si, 2:No');
            $table->json('discapacidades')->nullable();

            $table->smallInteger('grado_gwdata_id')->nullable();
            $table->smallInteger('seccion_gwdata_id')->nullable();
            $table->smallInteger('turno_gwdata_id')->nullable();
            $table->smallInteger('actividad_gwdata_id')->nullable();
            

            $table->string('departamento_escuela_gwdata_code_state', 20)->nullable();
            $table->string('municipio_escuela_gwdata_code_municipality', 20)->nullable();
            $table->integer('escuela_gwdata_id')->nullable();

            $table->string('municipio_reside_gwdata_code_municipality', 20)->nullable();
            $table->string('departamento_reside_gwdata_code_state', 20)->nullable();

            $table->string('signature_representante')->nullable();
            $table->string('signature_nna')->nullable();

            
            $table->datetime('active_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);
            $table->datetime('imported_at')->nullable();
            $table->integer('imported_by')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_nnas');
    }
};
