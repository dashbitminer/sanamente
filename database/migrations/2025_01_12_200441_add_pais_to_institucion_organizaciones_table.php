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
            $table->foreignId('pais_id')
                ->after('slug')
                ->nullable()
                ->constrained('paises', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institucion_organizaciones', function (Blueprint $table) {
            //
        });
    }
};
