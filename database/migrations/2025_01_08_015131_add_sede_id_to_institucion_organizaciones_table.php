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
        Schema::table('institucion_organizaciones', function (Blueprint $table) {
            $table->json('sede_id')
                ->after('slug')
                ->nullable()
                ->comment('Lista de sede_id asociadas a la organización en formato json');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institucion_organizaciones', function (Blueprint $table) {
            $table->dropColumn('sede_id');
        });
    }
};
