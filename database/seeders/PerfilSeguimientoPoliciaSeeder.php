<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeguimientoPoliciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            'Estudiante de la Academia Nacional de la Policía',
            'Personal de la Policía de Tránsito',
            'Personal de la Policía Municipal',
            'Personal de la Policía Nacional',
        ];

        foreach ($opciones as $opcion) {
            $perfilSeguimientoPolicia = \App\Models\PerfilSeguimientoPolicia::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $perfilSeguimientoPolicia->paises()->attach([1, 2, 3]);
        }
    }
}
