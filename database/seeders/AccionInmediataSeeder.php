<?php

namespace Database\Seeders;

use App\Models\AccionInmediata;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AccionInmediataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Ninguna',
            'Gestión de albergue o resguardo de emergencia',
            'Gestión de transporte',
            'Gestión de alimentos',
            'Gestión de medicamentos',
            'Asistencia económica',
            'Primeros Auxilios Psicológicos',
            'Protocolo SanaMente',
            'Atención médica de emergencia',
            'Otras'
        ];


        foreach ($values as $value) {
            $model = AccionInmediata::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
