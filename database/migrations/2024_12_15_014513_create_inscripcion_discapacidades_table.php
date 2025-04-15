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
        Schema::create('inscripcion_discapacidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscripcion_id')
                ->nullable()
                ->constrained('inscripciones', 'id', 'fk_inscripcion_discapacidades_inscripciones');
            $table->integer('discapacidad_id')->nullable();
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
        Schema::dropIfExists('inscripcion_discapacidades');
    }
};
