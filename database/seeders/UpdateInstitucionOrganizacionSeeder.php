<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;

class UpdateInstitucionOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Actualizar categorias para Salud
        $salud = InstitucionOrganizacion::where('nombre', 'Salud')
            ->whereNot('pais_id', 2)
            ->get();

        $ids = [1, 2, 16, 17, 20, 25];

        foreach ($salud as $model) {
            $model->sede_id = json_encode($ids);
            $model->save();
        }


        // Actualizar categorias para Educacion
        $educacion = InstitucionOrganizacion::where('nombre', 'Educación')
            ->whereNot('pais_id', 2)
            ->get();

        $ids = [15, 22, 0];

        foreach ($educacion as $model) {
            $model->sede_id = json_encode($ids);
            $model->save();
        }


        // Actualizar categorias para Seguridad Publica
        $seguridad = InstitucionOrganizacion::where('nombre', 'Seguridad pública')
            ->whereNot('pais_id', 2)
            ->get();

        $ids = [8, 9, 23, 24, 26];

        foreach ($seguridad as $model) {
            $model->sede_id = json_encode($ids);
            $model->save();
        }


        // Actualizar categorias para Organizaciones e instituciones
        $organizacion = InstitucionOrganizacion::where('nombre', 'Organizaciones e instituciones')
            ->whereNot('pais_id', 2)
            ->get();

        $ids = [3, 4, 5, 6, 7, 10, 11, 12, 13, 14, 18, 19];

        foreach ($organizacion as $model) {
            $model->sede_id = json_encode($ids);
            $model->save();
        }
    }
}
