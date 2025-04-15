<?php

namespace Database\Seeders;

use App\Models\OtraCondicion;
use App\Models\TipoServicio;
use App\Models\TipoViolencia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Servicios de educación',
            'Servicios de formación superior/complementaria',
            'Servicios de salud mental',
            'Servicios médicos',
            'Servicios de recreación',
            'Servicios de acompañamiento a sobrevivencia de violencia',
            'Servicios de rehabilitación para adicciones a drogas, alcohol u otras sustancias',
            'Servicios migratorios',
            'Servicios legales y jurídicos',
            'Servicios de empleabilidad o intermediación laboral',
            'Servicios de asistencia técnica para emprendimientos y medios de vida',
            'Escuelas Comunitarias (Glasswing)',
            'Programas de juventud (Glasswing)',
            'Programas de género (Glasswing)',
            'Programas de Salud Mental (SanaMente - Glasswing)',
            'Fondo de crisis/emergencia',
            'Otros (especifica):',
        ];

        foreach ($values as $value) {
            $model = TipoServicio::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);

            $model->paises()->attach([1, 2, 3]);
        }
    }
}
