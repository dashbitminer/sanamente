<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;

class UpdateMiembroComunidadParaMexico extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $miembro_comunidad = InstitucionOrganizacion::where('nombre', 'Miembro de la comunidad')
            ->where('pais_id', 4)
            ->first();

        $sedes = [17, 16, 1, 2, 20, 25, 14, 13, 12, 19, 5, 6, 7, 18, 23, 10];

        if ($miembro_comunidad) {
            $miembro_comunidad->sede_id = json_encode($sedes);
            $miembro_comunidad->save();
        }
    }
}
