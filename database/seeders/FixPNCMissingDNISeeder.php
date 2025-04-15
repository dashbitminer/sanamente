<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inscripcion;
use App\Models\EscuelaGWDATA;
use App\Models\ParticipanteGWDATA;

class FixPNCMissingDNISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codigos = [
            'JDEEXG' => '6560',
            'JKVDMG' => '7667',
            'GDXVPG' => '2291',
            'JEXBWG' => '2170',
            'GWWYQG' => '7071',
            'JEONBJ' => '8599',
            'GYLWLJ' => '5337',
            'GQYPOG' => '4074',
            'ZGQNMJ' => '9403',
            'PGPLPG' => '6664',
        ];

        $inscripciones = Inscripcion::whereIn('codigo_confirmacion', array_keys($codigos))
            ->get();

        foreach ($inscripciones as $inscripcion) {
            $oldDNI = $inscripcion->documento_identidad;

            $inscripcion->documento_identidad = $codigos[$inscripcion->codigo_confirmacion];

            $dni = $this->buildDocumentoIdentidadParaPnc($inscripcion);

            $inscripcion->documento_identidad = $dni;
            $inscripcion->save();

            if ($inscripcion->imported_at) {
                $participante = ParticipanteGWDATA::where('name', $inscripcion->nombres)
                    ->where('surname', $inscripcion->apellidos)
                    ->where('DNI', $oldDNI)
                    ->first();

                if ($participante) {
                    $participante->DNI = $inscripcion->documento_identidad;
                    $participante->save();
                }
            }
        }
    }

    public function buildDocumentoIdentidadParaPnc(Inscripcion $inscripcion)
    {
        $escuela = EscuelaGWDATA::find($inscripcion->pertenece_sede_id);
        $codigoEscuela = strpos($escuela->code, ',') !== false ? explode(',', $escuela->code)[1] : $escuela->code;

        $fullName = $this->removeAccents($inscripcion->nombres . $inscripcion->apellidos);
        $shortName = substr(str_replace(' ', '', $fullName), 0, 10);

        return strtoupper($shortName) . '/' . $codigoEscuela . '/' . $inscripcion->documento_identidad;
    }

    public function removeAccents($text)
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

        $text = strtr($text, [
            '~' => '', '`' => '', "'" => '', '"' => '', '^' => '', '´' => '', '¨' => ''
        ]);

        return $text;
    }
}
