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
        Schema::create('intervencion_participantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('documento_identidad')->nullable();
            $table->tinyInteger('nacionalidad')->nullable()->comment('1:Guatemalteco, 2:El Salvador, 3:Honduras, 4:Costa Rica, 5:Panama, 6:Mexicano, 7:Colombia');
            $table->date("fecha_nacimiento")->nullable();
            $table->tinyInteger('sexo')->nullable()->comment('1:Femenino, 2:Masculino');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->datetime('active_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by')->nullable()->default(null);
            $table->integer('updated_by')->nullable()->default(null);
            $table->integer('deleted_by')->nullable()->default(null);

            $table->index(['nombres', 'documento_identidad']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervencion_participantes');
    }
};
