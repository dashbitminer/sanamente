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
        Schema::create('intervencion_tipo_otra_intervencion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intervencion_id')
                ->constrained('intervenciones', 'id', 'fk_intervenciones_intervencion_id');
            $table->foreignId('tipo_otra_intervencion_id')
                ->constrained('tipo_otras_intervenciones', 'id', 'fk_tipo_otras_intervenciones_tipo_otra_intervencion_id');
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
        Schema::dropIfExists('intervencion_tipo_otra_intervencion');
    }
};
