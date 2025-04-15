<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeguimientoDocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones =[
            'Personal administrativo',
            'Personal de dirección/coordinación',
            'Personal docente',
            'Personal especializado (psicología, educación especial)',
        ];

        foreach ($opciones as $opcion) {
            $perfilSeguimientoDocente = \App\Models\PerfilSeguimientoDocente::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $perfilSeguimientoDocente->paises()->attach([1, 2, 3]);
        }
    }
}
