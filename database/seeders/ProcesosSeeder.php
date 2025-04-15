<?php

namespace Database\Seeders;

use App\Models\Proceso;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProcesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Se dejo por escrito la referencia en la institución',
            'Una persona de la institución atendió el caso de forma inmediata',
            'Se activó protocolo de la institución',
            'Se activó sistema de emergencia nacional',
            'Se deriva a la red de servicios y apoyos complementarios',
            'Se deriva a otra área dentro de la institución',
            'Otro',
        ];

        foreach ($values as $value) {
            $model = Proceso::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
