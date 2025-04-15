<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;
use App\Models\InstitucionOrganizacion;

class AddPaisToSedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Actualizar todas las categorias de sedes para El Salvador
        $el_salvador = Pais::where('slug', 'el-salvador')->first();

        if ($el_salvador) {
            $sedes = InstitucionOrganizacion::all();

            foreach ($sedes as $sede) {
                $sede->pais_id = $el_salvador->id;
                $sede->save();
            }
        }

        // Crear categorias de sedes para los demas paises
        $paises = Pais::where('slug', '!=', 'el-salvador')->pluck('id')->toArray();
        $sedes = InstitucionOrganizacion::whereNotLike('nombre', '%(CAM)')
            ->whereNotLike('nombre', '%(PNC)')
            ->get();

        foreach ($paises as $pais_id) {
            foreach ($sedes as $sede) {
                InstitucionOrganizacion::create([
                    'nombre' => $sede->nombre,
                    'sede_id' => $sede->sede_id,
                    'pais_id' => $pais_id,
                    'active_at' => now(),
                ]);
            }
        }
    }
}
