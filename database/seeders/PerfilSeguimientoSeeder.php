<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeguimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
           'Bombero',
           'Docente de educación básica (primaria) e intermedia (secundaria y diversificado)',
           'Docente de educación superior/profesional',
           'Personal de la Policía',
           'Personal de Organizaciones',
           'Personal de Salud',
           'Personal de protección civil municipal',
           'Socorrista',
        ];

        foreach ($opciones as $opcion) {
            $perfilSeguimiento = \App\Models\PerfilSeguimiento::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $perfilSeguimiento->paises()->attach([1, 2, 3]);
        }
    }
}
