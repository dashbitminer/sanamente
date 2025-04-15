<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CentroEducativoNivel;

class CentroEducativoNivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Prebásico',
            'Básico',
            'Medio',
            'Administrativo',
            'Técnico Pedagógico',
        ];

        foreach ($values as $value) {
            $model = CentroEducativoNivel::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            // $model->paises()->attach([1, 2, 3, 4, 5, 6, 7]);
        }
    }
}
