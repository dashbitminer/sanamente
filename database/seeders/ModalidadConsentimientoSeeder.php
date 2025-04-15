<?php

namespace Database\Seeders;

use App\Models\ModalidadConsentimiento;
use App\Models\OtraCondicion;
use App\Models\TipoViolencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModalidadConsentimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Registro de consentimiento físico',
            'Registro de consentimiento en Línea',
            'Registro de consentimiento verbal',
        ];

        foreach ($values as $value) {
            $model = ModalidadConsentimiento::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
