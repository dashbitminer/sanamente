<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RazonIntervencion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RazonIntervencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Alto riesgo de suicidio',
            'Participante victima de violencia de género',
            'Solicitud de información fuera de las 5 categorías establecidas en el protocolo',
            'Condición en salud mental con diagnóstico psiquiátrico',
            'Aplicación de protocolo institucional o leyes nacionales',
            'Atención requerida fuera del protocolo institucional',
            'Otro',
        ];

        foreach ($values as $value) {
            $model = RazonIntervencion::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
