<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InstitucionOrganizacion;
use App\Models\Pais;

class AddMiembroComunidad extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = Pais::whereIn('nombre', ['México', 'Colombia', 'Panamá'])
            ->pluck('id')
            ->toArray();

        foreach ($paises as $pais_id) {
            InstitucionOrganizacion::create([
                'nombre' => 'Miembro de la comunidad',
                'pais_id' => $pais_id,
                'active_at' => now(),
            ]);
        }
    }
}
