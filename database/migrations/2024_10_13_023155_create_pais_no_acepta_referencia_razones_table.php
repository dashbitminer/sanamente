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
        Schema::create('pais_no_acepta_referencia_razones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pais_id')->constrained('paises');
            $table->foreignId('no_acepta_referencia_razon_id')
                ->constrained('no_acepta_referencia_razones', 'id', 'fk_no_acepta_referencia_razon_id');
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
        Schema::dropIfExists('pais_no_acepta_referencia_razones');
    }
};
