<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoOtraIntervencion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoOtraIntervencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Brinda psicoeducación (normaliza la situación, válida emociones, práctica de estrategias, entre otras)',
            'Ayuda para contactarse con un familiar',
            'Acompañamiento en atención o servicio requerido (exámenes, búsqueda de un área en específico, entre otras)',
        ];

        foreach ($values as $value) {
            $model = TipoOtraIntervencion::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
