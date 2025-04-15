<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoPsicoeducacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoPsicoeducacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Hablemos de estrés',
            'Hablemos de trauma',
            'Hablemos de depresión',
            'Hablemos de ansiedad',
            'Hablemos de duelo',
        ];

        foreach ($values as $value) {
            $model = TipoPsicoeducacion::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
