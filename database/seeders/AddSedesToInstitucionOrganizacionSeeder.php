<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;
use App\Models\CentroEducativoCargo;
use App\Models\CentroEducativoNivel;
use App\Models\CentroEducativoCiclo;

class AddSedesToInstitucionOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remover Seguridad publica
        $seguridad_publica = InstitucionOrganizacion::find(3);

        if ($seguridad_publica) {
            $seguridad_publica->delete();
        }

        // Agregar las sedes para Salud
        $salud = InstitucionOrganizacion::find(1);

        if ($salud) {
            $salud->sede_id = json_encode([17, 16, 1, 2, 20, 25]);
            $salud->save();
        }

        // Agregar las sedes para Educación
        $educacion = InstitucionOrganizacion::find(2);

        if ($educacion) {
            $educacion->sede_id = json_encode([22, 0, 15]);
            $educacion->save();
        }

        // Agregar las sedes para Organizaciones e instituciones
        $organizaciones = InstitucionOrganizacion::find(4);

        if ($organizaciones) {
            $organizaciones->sede_id = json_encode([14, 13, 12, 19, 5, 6, 7, 18]);
            $organizaciones->save();
        }

        // Agregar las sedes para Cuerpo de Agentes Municipales o Metropolitanos (CAM)
        $cam = InstitucionOrganizacion::create([
            'nombre' => 'Cuerpo de Agentes Municipales o Metropolitanos (CAM)',
            'sede_id' => json_encode([23]),
            'active_at' => now(),
        ]);

        // Agregar las sedes para Policia Nacional Civil (PNC)
        $pnc = InstitucionOrganizacion::create([
            'nombre' => 'Policia Nacional Civil (PNC)',
            'sede_id' => json_encode([8, 26, 9, 24]),
            'active_at' => now(),
        ]);


        // Fix CentroEducativoCargo
        CentroEducativoCargo::whereLike('slug', '%-2')->get()->each(function ($model) {
            $model->delete();
        });

        $values = [
            'Secretario(a)',
            'Consejero(a)',
            'Orientador(a)',
        ];

        foreach ($values as $value) {
            CentroEducativoCargo::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);
        }

        // Fix CentroEducativoNivel
        CentroEducativoNivel::whereLike('slug', '%-2')->get()->each(function ($model) {
            $model->delete();
        });

        $values = [
            'Administrativo',
            'Técnico Pedagógico',
        ];

        foreach ($values as $value) {
            CentroEducativoNivel::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);
        }

        // Fix CentroEducativoCiclo
        CentroEducativoCiclo::whereLike('slug', '%-2')->get()->each(function ($model) {
            $model->delete();
        });

        $values = [
            'Ninguno',
        ];

        foreach ($values as $value) {
            CentroEducativoCiclo::create([
                'nombre' => $value,
                'active_at' => now(),
            ]);
        }
    }
}
