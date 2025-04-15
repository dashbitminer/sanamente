<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;

class UpdateSedeCategoriasElSalvadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Actualizar Seguridad Publica para "Sede Municipal de Seguridad Pública" y "Sede Municipal"
        $seguridad_publica = InstitucionOrganizacion::where('nombre', 'Seguridad pública')
            ->where('pais_id', 2)
            ->get();

        foreach ($seguridad_publica as $institucion) {
            $institucion->sede_id = json_encode([12, 23]);
            $institucion->save();
        }


        // Agregar "Sede Municipal de Seguridad Pública" a "Organizaciones e instituciones"
        $organizaciones = InstitucionOrganizacion::where('nombre', 'Organizaciones e instituciones')
            ->where('pais_id', 2)
            ->get();

        foreach ($organizaciones as $institucion) {
            $institucion->sede_id = json_encode([14, 13, 12, 19, 5, 6, 7, 18, 23]);
            $institucion->save();
        }
    }
}
