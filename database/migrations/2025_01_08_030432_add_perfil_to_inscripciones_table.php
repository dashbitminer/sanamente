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
        Schema::table('inscripciones', function (Blueprint $table) {
            $table->integer('institutional_person_id_gwdata')
                ->after('ha_participado_actividades_glasswing')
                ->nullable()
                ->comment('Campo de GWDATA beneficiaries.institutional_person_id');

            $table->integer('beneficiaries_subtype_id_gwdata')
                ->after('institutional_person_id_gwdata')
                ->nullable()
                ->comment('Campo de GWDATA beneficiaries.beneficiaries_subtype_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscripciones', function (Blueprint $table) {
            $table->dropColumn('institutional_person_id_gwdata');
            $table->dropColumn('beneficiaries_subtype_id_gwdata');
        });
    }
};
