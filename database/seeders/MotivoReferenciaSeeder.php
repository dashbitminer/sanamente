<?php

namespace Database\Seeders;

use App\Models\MotivoReferencia;
use App\Models\OtraCondicion;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MotivoReferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Sobreviviente de violencia',
            'Discriminación',
            'Amenazas a sí misma o personas cercanas',
            'Condición médica',
            'Riesgo suicida',
            'Dificultades educativas',
            'Desplazamiento forzado',
            'Reinserción laboral',
            'Condiciones de Salud Mental',
            'Asesoramiento especializado',
            'Otros',
        ];

        foreach ($values as $value) {
            $model = MotivoReferencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
