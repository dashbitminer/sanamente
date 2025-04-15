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
        Schema::create('sanamente_estrategias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('protocolo_sanamente_id')
                ->constrained('protocolo_sanamentes', 'id', 'fk_sanamente_estrategias_protocolo_sanamente');
            $table->foreignId('estrategia_id')
                ->constrained('estrategias', 'id', 'fk_sanamente_estrategias_estrategias');
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
        Schema::dropIfExists('sanamente_estrategias');
    }
};
