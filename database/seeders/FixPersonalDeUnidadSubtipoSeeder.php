<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\ParticipanteGWDATA;

class FixPersonalDeUnidadSubtipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accountsFixed = [];

        $inscripciones = Inscripcion::with([
            "personalInstitucional:id,name",
            "beneficiarioSubtipoEducacion:id,name,institutional_person_id",
            "beneficiarioSubtipoOrganizaciones:id,name,id_institucional,id_beneficiaries_sub",
            "sanamenteSubtiposPolicia:id,name,id_institucional,id_beneficiaries_sub",
            "beneficiarioSubtipoPoliciaRango:id,name,institutional_person_id",
            "sanamenteSubtiposSalud:id,name,id_institucional,id_beneficiaries_sub",
            "beneficiarioSubtipoSalud:id,name,institutional_person_id",
        ])->whereNotNull('imported_at')
        ->where('perfil_institucional_id', 2)
        ->where('perfil_rango_salud_id', 10)
        // ->where('codigo_confirmacion', 'JVWMWG')
        ->get();

        foreach ($inscripciones as $inscripcion) {
            $perfilInstitucional = $inscripcion->personalInstitucional->name ?? null;
            $personalSalud = null;

            if ($perfilInstitucional) {
                if (str_contains($perfilInstitucional, 'Personal de Salud')) {
                    if (str_contains($inscripcion->sanamenteSubtiposSalud->name, 'Personal de Unidad')) {
                        $personalSalud = $inscripcion->beneficiarioSubtipoSalud->id ?? null;
                    }
                }

                if ($personalSalud) {
                    $participanteGWDATA = ParticipanteGWDATA::where('DNI', $inscripcion->documento_identidad)
                        // ->where('is_imported', 1)
                        ->first();

                    $accountsFixed[$inscripcion->documento_identidad] = $inscripcion->beneficiarioSubtipoSalud->name ?? null;

                    if ($participanteGWDATA) {
                        $participanteGWDATA->beneficiaries_subtype_id = $personalSalud;
                        $participanteGWDATA->save();
                    }
                }
            }
        }

        dd($accountsFixed);
    }
}
