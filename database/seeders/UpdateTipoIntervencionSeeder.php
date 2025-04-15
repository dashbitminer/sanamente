<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;
use App\Models\TipoIntervencion;

class UpdateTipoIntervencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = Pais::pluck('id')->toArray();

        $model = TipoIntervencion::create([
            'nombre' => 'Apoyo psicosocial nivel 2',
            'active_at' => now(),
        ]);

        $model->paises()->attach($paises);
    }
}
