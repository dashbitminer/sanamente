<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;
use App\Models\Pais;

class UpdateCamToSeguridadPublica extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seguridad_publica = InstitucionOrganizacion::where('nombre', 'Cuerpo de Agentes Municipales o Metropolitanos (CAM)')
            ->first();

        // Actualizar a Seguridad Publica
        if ($seguridad_publica) {
            $seguridad_publica->nombre = 'Seguridad pública';
            $seguridad_publica->slug = 'seguridad-publica';
            $seguridad_publica->save();

            // Crear seguridad publica para los demas paises
            $paises = Pais::where('slug', '!=', 'el-salvador')->pluck('id')->toArray();

            foreach ($paises as $pais_id) {
                InstitucionOrganizacion::create([
                    'nombre' => $seguridad_publica->nombre,
                    'sede_id' => $seguridad_publica->sede_id,
                    'pais_id' => $pais_id,
                    'active_at' => now(),
                ]);
            }
        }
    }
}
