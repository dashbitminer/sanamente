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
        Schema::table('intervenciones', function (Blueprint $table) {
            $table->tinyInteger('tipo_intervencion')
                ->after('intervencion_participante_id')
                ->nullable()
                ->comment('1:Individual, 2:Grupal');

            $table->integer('cantidad_hombres')->after('tipo_intervencion')->nullable();
            $table->integer('cantidad_mujeres')->after('cantidad_hombres')->nullable();

            $table->tinyInteger('discapacidad')
                ->after('referencia_intervencion_id')
                ->nullable()
                ->comment('1:Si, 2:No');
            $table->json('discapacidad_id')
                ->after('discapacidad')
                ->nullable()
                ->comment('Lista de discapacidad id');

            $table->text('comentario_apoyo_psicosocial')
                ->after('comentario')
                ->nullable()
                ->default(null);

            $table->foreignId('perfil_participante_id')
                ->nullable()
                ->change();

            $table->json('perfil_participante')
                ->after('perfil_participante_id')
                ->nullable();

            $table->boolean('compartir_informacion')
                ->nullable()
                ->change();
        });

        Schema::table('primeros_auxilios_psicologicos', function (Blueprint $table) {
            $table->text('consentimiento')
                ->after('id')
                ->nullable()
                ->comment('Adjunte el consentimiento informado de la persona participante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intervenciones', function (Blueprint $table) {
            //
        });
    }
};
