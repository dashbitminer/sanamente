<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaisPerfilSeguimiento;
use App\Models\PaisActividadSeguimiento;
use App\Models\PaisPerfilSeguimientoDocente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FGSMUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [4, 6, 7, 8];

        for ($i = 1; $i <= 6; $i++) {
            foreach ($paises as $p) {

                $pais = \App\Models\Pais::find($p);

                PaisActividadSeguimiento::firstOrCreate([
                    'pais_id' => $pais->id,
                    'actividad_seguimiento_id' => $i,
                ], ['active_at' => now()]);
            }
        }

        // Perfil Seguimientos
        for ($i = 1; $i <= 8; $i++) {
            foreach ($paises as $p) {
                $pais = \App\Models\Pais::find($p);

                PaisPerfilSeguimiento::firstOrCreate([
                    'pais_id' => $pais->id,
                    'perfil_seguimiento_id' => $i,
                ], ['active_at' => now()]);
            }
        }

        // Perfil Seguimientos Doentes

        for ($i = 1; $i <= 4; $i++) {
            foreach ($paises as $p) {
                $pais = \App\Models\Pais::find($p);

                PaisPerfilSeguimientoDocente::firstOrCreate([
                    'pais_id' => $pais->id,
                    'perfil_seguimiento_docente_id' => $i,
                ], ['active_at' => now()]);
            }
        }

        // Perfil hospitales

        for ($i = 1; $i <= 11; $i++) {
            foreach ($paises as $p) {
                $pais = \App\Models\Pais::find($p);

                \App\Models\PaisPerfilSeguimientoHospital::firstOrCreate([
                    'pais_id' => $pais->id,
                    'perfil_seguimiento_hospital_id' => $i,
                ], ['active_at' => now()]);
            }
        }

        // Perfil Organizaciones

        for ($i = 1; $i <= 4; $i++) {
            foreach ($paises as $p) {
                $pais = \App\Models\Pais::find($p);

                \App\Models\PaisPerfilSeguimientoOrganizacion::firstOrCreate([
                    'pais_id' => $pais->id,
                    'perfil_seguimiento_organizacion_id' => $i,
                ], ['active_at' => now()]);
            }
        }

        // Perfil Policias

        for ($i = 1; $i <= 4; $i++) {
            foreach ($paises as $p) {
                $pais = \App\Models\Pais::find($p);

                \App\Models\PaisPerfilSeguimientoPolicia::firstOrCreate([
                    'pais_id' => $pais->id,
                    'perfil_seguimiento_policia_id' => $i,
                ], ['active_at' => now()]);
            }
        }

        // Rango Policias

        for ($i = 1; $i <= 10; $i++) {
            foreach ($paises as $p) {
                $pais = \App\Models\Pais::find($p);

                \App\Models\PaisRangoSeguimientoPolicia::firstOrCreate([
                    'pais_id' => $pais->id,
                    'rango_seguimiento_policia_id' => $i,
                ], ['active_at' => now()]);
            }
        }

        // Perfil Salud

        for ($i = 1; $i <= 3; $i++) {
            foreach ($paises as $p) {
                $pais = \App\Models\Pais::find($p);

                \App\Models\PaisPerfilSeguimientoSalud::firstOrCreate([
                    'pais_id' => $pais->id,
                    'perfil_seguimiento_salud_id' => $i,
                ], ['active_at' => now()]);
            }
        }

    }
}
