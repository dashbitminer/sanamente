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
        Schema::table('intervencion_participantes', function (Blueprint $table) {
            $table->string('codigo_confirmacion')
                ->after('documento_identidad')
                ->nullable()
                ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('intervencion_participantes', function (Blueprint $table) {
            $table->dropColumn('intervencion_participantes');
        });
    }
};
