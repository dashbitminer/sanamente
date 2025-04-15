<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\ParticipanteGWDATA;

class UpdateInscripcionPersonalOrganizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inscripciones = Inscripcion::with("beneficiarioSubtipoOrganizaciones:id,name,id_institucional,id_beneficiaries_sub")
            ->where('institucion_organizacion_id', 4)
            ->where('perfil_institucional_id', 3)
            ->whereNotNull('imported_at')
            ->select('perfil_rango_organizacion_id', 'documento_identidad')
            ->get();

        foreach ($inscripciones as $inscripcion) {
            $participante = ParticipanteGWDATA::where('DNI', $inscripcion->documento_identidad)->first();

            if ($participante) {
                $participante->beneficiaries_subtype_id = $inscripcion->beneficiarioSubtipoOrganizaciones->id_beneficiaries_sub;
                $participante->save();
            }
        }
    }
}
