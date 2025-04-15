<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeguimientoSaludSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            'Estudiante de carreras relacionadas a la Salud',
            'Personal de hospital',
            'Personal de Unidad de Salud/Clínica comunitaria',
        ];

        foreach ($opciones as $opcion) {
            $perfilSeguimientoSalud = \App\Models\PerfilSeguimientoSalud::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $perfilSeguimientoSalud->paises()->attach([1, 2, 3]);
        }
    }
}
