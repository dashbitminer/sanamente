<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\EscuelaGWDATA;
use App\Models\ParticipanteGWDATA;

class FixImportedPNCParticipantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fix_school_code = [];
        $sedes = [];

        // Obtener todos los participantes pnc
        $inscripciones = Inscripcion::where('is_pnc', 1)->get();

        foreach ($inscripciones as $inscripcion) {
            $fix_school_code[$inscripcion->id] = [
                'documento_identidad' => $inscripcion->documento_identidad,
                'school_id' => $inscripcion->pertenece_sede_id,
                'imported' => !empty($inscripcion->imported_at),
            ];

            $sedes[$inscripcion->pertenece_sede_id] = $inscripcion->pertenece_sede_id;
        }


        // Obtener todas las sedes de los participantes
        $escuelas = EscuelaGWDATA::select('id', 'code', 'fkCodeCountry')
            ->whereIn('id', $sedes)->get();

        foreach ($escuelas as $escuela) {
            $codigoEscuela = strpos($escuela->code, ',') !== false
                ? explode(',', $escuela->code)[1] : $escuela->code;

            $sedes[$escuela->id] = $codigoEscuela;
        }



        foreach ($fix_school_code as $value) {
            // Modificar el documento unico para todos los importados en GWDATA
            if ($value['imported']) {
                $participanteGWDATA = ParticipanteGWDATA::where('DNI', $value['documento_identidad'])
                    ->where('is_imported', 1)
                    ->first();

                if ($participanteGWDATA) {
                    $participanteGWDATA->DNI = str_replace(
                        "/{$value['school_id']}/",
                        "/{$sedes[$value['school_id']]}/",
                        $participanteGWDATA->DNI
                    );

                    $participanteGWDATA->save();
                }
            }

            // Modificar el documento unico para todos participantes
            $participante = Inscripcion::where('documento_identidad', $value['documento_identidad'])
                ->first();

            if ($participante) {
                $participante->documento_identidad = str_replace(
                    "/{$value['school_id']}/",
                    "/{$sedes[$value['school_id']]}/",
                    $participante->documento_identidad
                );

                $participante->save();
            }
        }
    }
}
