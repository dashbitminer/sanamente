<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Intervencion;

class UpdatePerfilParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pasar todos los participantes id a json
        $intervenciones = Intervencion::all();

        foreach ($intervenciones as $intervencion) {
            $intervencion->perfil_participante = json_encode([(string) $intervencion->perfil_participante_id]);
            $intervencion->save();
        }
    }
}
