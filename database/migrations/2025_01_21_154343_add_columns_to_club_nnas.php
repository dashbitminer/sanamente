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
        Schema::table('club_nnas', function (Blueprint $table) {
            $table->boolean('firma_digital_representante')->nullable()->after('autorizacion_nna');
            $table->boolean('firma_digital_nna')->nullable()->after('autorizacion_nna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('club_nnas', function (Blueprint $table) {
            //
        });
    }
};
