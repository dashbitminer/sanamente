<?php

namespace Database\Seeders;

use App\Models\OtraCondicion;
use App\Models\TipoViolencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoViolenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Violencia física',
            'Violencia económica de pareja',
            'Violencia emocional/Psicológica de pareja o tutelar',
            'Violencia basada en género',
            'Extorsión',
            'Secuestro',
            'Reclutamiento forzado',
            'Abuso sexual',
            'Explotación laboral infantil',
            'No sabe/No desea responder',
        ];

        foreach ($values as $value) {
            $model = TipoViolencia::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
