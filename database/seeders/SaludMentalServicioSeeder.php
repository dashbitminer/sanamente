<?php

namespace Database\Seeders;

use App\Models\OtraCondicion;
use App\Models\SaludMentalServicio;
use App\Models\TipoServicio;
use App\Models\TipoViolencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SaludMentalServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Atención psicológica',
            'Atención psiquiátrica',
            'Atención psicosocial',
        ];

        foreach ($values as $value) {
            $model = SaludMentalServicio::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
