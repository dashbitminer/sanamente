<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadSeguimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            'Taller Cuida-T SanaMente',
            'Taller principio #1 "Haciendo malabarismo en equipo" ',
            'Taller principio #2 "Evitamos la incertidumbre"',
            'Taller principio #3 "Respetamos el ritmo de cada jinete"',
            'Taller principio #4 "Le damos a todos una primera oportunidad"',
            'Taller principio #5 "Le damos a todos una segunda oportunidad"',
        ];

        foreach ($opciones as $opcion) {
            $actividadSeguimiento = \App\Models\ActividadSeguimiento::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $actividadSeguimiento->paises()->attach([1, 2, 3]);
        }
    }
}
