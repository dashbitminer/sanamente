<?php

namespace Database\Seeders;

use App\Models\SeguimientoFormacionGeneral;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixCodigoConfirmacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeguimientoFormacionGeneral::all()->each(function (SeguimientoFormacionGeneral $seguimientoFormacionGeneral) {

            $codigo = $seguimientoFormacionGeneral->codigo_confirmacion;
            $pais = $seguimientoFormacionGeneral->pais_id;
            $dui = $seguimientoFormacionGeneral->documento_identidad;

            $exists = SeguimientoFormacionGeneral::where('codigo_confirmacion', $codigo)
                ->where('pais_id', $pais)
                ->where('documento_identidad', '!=', $dui)
                ->where('nombres', '!=', $seguimientoFormacionGeneral->nombres)
                ->where('apellidos', '!=', $seguimientoFormacionGeneral->apellidos)
                ->where('id', '<', $seguimientoFormacionGeneral->id)
                ->exists();

            if ($exists) {
                // Handle the case where a record with the same codigo_confirmacion and pais_id exists
                $seguimientoFormacionGeneral->codigo_confirmacion = \App\Facades\TicketCode::generateFor($seguimientoFormacionGeneral);

                $seguimientoFormacionGeneral->save();

            }


        });
    }
}
