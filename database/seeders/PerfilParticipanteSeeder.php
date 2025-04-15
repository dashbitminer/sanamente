<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PerfilParticipante;

class PerfilParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Personal de Salud',
            'Personal Docente',
            'Personal de la Policía',
            'Paciente de  hospitales o centros de salud',
            'Familiares de pacientes de hospitales o centros de salud',
            'Miembros de la comunidad educativa',
            'Miembros de la comunidad',
            'Staff Glasswing',
        ];

        foreach ($values as $value) {
            $model = PerfilParticipante::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
