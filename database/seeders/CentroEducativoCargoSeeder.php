<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CentroEducativoCargo;

class CentroEducativoCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Director',
            'Subdirector',
            'Docente',
            'Secretario(a)',
            'Consejero(a)',
            'Orientador(a)',
        ];

        foreach ($values as $value) {
            $model = CentroEducativoCargo::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            // $model->paises()->attach([1, 2, 3, 4, 5, 6, 7]);
        }
    }
}
