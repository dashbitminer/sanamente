<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RangoSeguimientoPoliciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            'Acondicionador Físico',
            'Capellán',
            'Nivel básico (Agentes,Cabos, Sargentos)',
            'Nivel ejecutivo (Subinspector, Inspector, Inspector Jefe, Comisionado)',
            'Nivel superior (Subcomisionado, Comisionado)',
            'Personal Administrativo',
            'Personal de enfermería',
            'Personal médico',
            'Psicólogo(a)',
            'Trabajador(a) social',
        ];

        foreach ($opciones as $opcion) {
            $rangoSeguimientoPolicia = \App\Models\RangoSeguimientoPolicia::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $rangoSeguimientoPolicia->paises()->attach([1, 2, 3], ['active_at' => now()]);
        }
    }
}
