<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;

class UpdateSectorMiembroComunidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $miembro_comunidad = InstitucionOrganizacion::where('nombre', 'Miembro de la comunidad')
            ->get();

        $salud = [17, 16, 1, 2, 20, 25];
        $organizacion = [14, 13, 12, 19, 5, 6, 7, 18, 23];

        foreach ($miembro_comunidad as $institucion) {
            $institucion->sede_id = json_encode(array_merge($salud, $organizacion));
            $institucion->save();
        }
    }
}
