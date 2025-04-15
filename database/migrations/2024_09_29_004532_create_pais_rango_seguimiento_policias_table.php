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
        Schema::create('pais_rango_seguimiento_policias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_id')->constrained('paises');
            $table->foreignId('rango_seguimiento_policia_id')->constrained('rango_seguimiento_policias', 'id', 'fk_rango_seguimiento_policias_id');
            $table->timestamp('active_at')->nullable()->default(null);
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
        Schema::dropIfExists('pais_rango_seguimiento_policias');
    }
};
