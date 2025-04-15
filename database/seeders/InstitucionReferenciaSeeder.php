<?php

namespace Database\Seeders;

use App\Models\InstitucionReferencia;
use App\Models\OtraCondicion;
use App\Models\TipoServicio;
use App\Models\TipoViolencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstitucionReferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Institucion 1',
            'Institucion 2',
            'Institucion 3',
            'Institucion 4',
            'Institucion 5',
            'Otra',
        ];

        foreach ($values as $value) {
            $model = InstitucionReferencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
