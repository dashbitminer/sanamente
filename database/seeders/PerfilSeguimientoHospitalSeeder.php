<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeguimientoHospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
           'Jefaturas/Direcciones',
           'Personal de enfermería',
           'Personal médico',
           'Personal de salud mental',
           'Personal técnico',
           'Personal transitorio',
           'Personal de Outsorcing',
           'Promotor de salud ',
           'Personal administrativo',
           'Personal de apoyo (camillero, guardia, farmacia, motorista)',
           'Otras especialidades',
        ];

        foreach ($opciones as $opcion) {
            $perfilSeguimientoHospital = \App\Models\PerfilSeguimientoHospital::create([
                'nombre' => $opcion,
                'active_at' => now(),
            ]);

            $perfilSeguimientoHospital->paises()->attach([1, 2, 3]);
        }
    }
}
