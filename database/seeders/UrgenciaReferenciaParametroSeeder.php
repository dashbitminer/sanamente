<?php

namespace Database\Seeders;

use App\Models\OtraCondicion;
use App\Models\TipoServicio;
use App\Models\TipoViolencia;
use App\Models\UrgenciaReferenciaParametro;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UrgenciaReferenciaParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Máxima urgencia (máx 24 horas)',
            'Muy urgente (máx 3 días)',
            'Urgencia moderada (1-2 semanas)',
            'Urgencia leve (2-4 semanas)',
        ];

        foreach ($values as $value) {
            $model = UrgenciaReferenciaParametro::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
