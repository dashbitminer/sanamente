<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeguimientoOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            'Personal de ONG',
            'Personal de Institución de gobierno',
            'Junta directiva o junta comunal',
            'Sistema de protección nacional infantil'
        ];

        foreach ($opciones as $opcion) {
            $perfilSeguimientoOrganizacion = \App\Models\PerfilSeguimientoOrganizacion::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $perfilSeguimientoOrganizacion->paises()->attach([1, 2, 3]);
        }
    }
}
