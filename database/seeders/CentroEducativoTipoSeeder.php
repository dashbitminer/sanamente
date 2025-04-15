<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CentroEducativoTipo;

class CentroEducativoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Unidocente',
            'Bidocente',
            'Multidocente',
        ];

        foreach ($values as $value) {
            $model = CentroEducativoTipo::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            // $model->paises()->attach([1, 2, 3, 4, 5, 6, 7]);
        }
    }
}
