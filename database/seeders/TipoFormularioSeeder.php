<?php

namespace Database\Seeders;

use App\Models\TipoFormulario;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoFormularioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoFormulario::create([
            'nombre' => 'Registro de seguimiento a FGSM',
            'active_at' => now(),
        ]);

        TipoFormulario::create([
            'nombre' => 'Registro de intervenciones directas',
            'active_at' => now(),
        ]);

        TipoFormulario::create([
            'nombre' => 'Registro de referencias',
            'active_at' => now(),
        ]);
    }
}
