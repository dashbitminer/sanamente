<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CentroEducativoCiclo;

class CentroEducativoCicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Primer ciclo',
            'Segundo ciclo',
            'Tercer ciclo',
            'Ninguno',
        ];

        foreach ($values as $value) {
            $model = CentroEducativoCiclo::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            // $model->paises()->attach([1, 2, 3, 4, 5, 6, 7]);
        }
    }
}
