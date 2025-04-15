<?php

namespace App\Livewire\ClubNNA\Traits;

use App\Models\ClubNNA;
use App\Models\DiscapacidadGWDATA;
use App\Models\EscuelaGWDATA;
use App\Models\GradoGWDATA;
use App\Models\MunicipioGWDATA;
use App\Models\ParentescoGWDATA;
use Exception;
use Illuminate\Support\Facades\Storage;

trait ClubNNATrait 
{
    use LabelsTrait;
    const NACIONAL = 1;

    const EXTRANJERO = 2;
    public function getData(): array
    {
        $departamentos = \App\Models\DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)
                                    ->orderBy("name")->pluck("name", "codeState");

        $departamentosSede = EscuelaGWDATA::getUniqueStatesWithActiveSedesAndComponentsNNA($this->pais->codigo)
        ->pluck('name', 'fkCodeState');

        $discapacidades = DiscapacidadGWDATA::discapacidades()->pluck('name', 'id');

        $parentescos = ParentescoGWDATA::parentescos()->pluck('name', 'id');

        $ultimosGrados = \App\Models\UltimoGradoGWDATA::pluck("name", "id");

        $nivelesAcademicos = \App\Models\NivelAcademicoGWDATA::whereNotNull('orden')->orderBy('orden')->pluck("name", "id");

        $secciones = \App\Models\SeccionGWDATA::active()->pluck('name', 'id');

        $turnos = \App\Models\TurnoGWDATA::take(4)->pluck('name', 'id');

        return[
            'discapacidades' => $discapacidades,
            'ultimosGrados' => $ultimosGrados,
            'departamentos' => $departamentos,
            'nivelesAcademicos' => $nivelesAcademicos,
            'secciones' => $secciones,
            'turnos' => $turnos,
            'parentescos' => $parentescos,
            'clubs' => collect([]),
            'departamentosReside' => $departamentosSede,
        ];
    }

    public function setCiudad($departamento_id)
    {
        return MunicipioGWDATA::where('fkCodeState', $departamento_id)
            ->orderBy('name')
            ->pluck("name", "codeMunicipality");
        
    }

    public function setSedeCiudad($departamento_id)
    {
        return EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponentNNA(
                $this->pais->codigo,
                $departamento_id
                )
                ->pluck('name', 'codeMunicipality');
    }

    public function getSedesEscuelas($codigoMunicipio)
    {

        return EscuelaGWDATA::getActiveSchoolsNNA($this->pais->codigo, $codigoMunicipio)
            ->pluck('name', 'school_id');
    }

    public function resetForm()
    {
        $this->form->reset(
            'autorizacion_participacion',
            'autorizacion_datos_personales',
            'autorizacion_voz_image',
            'autorizacion_consentimiento',
            'nombres_responsable',
            'parentesco',
            'telefono',
            'documento_identidad',
            'confirmo_copia_documento',
            'informado_sobre_nna',
            'nna_ha_escuchado',
            'leido_comprendido',
            'deseo_participar',
            'uso_recoleccion_datos',
            'uso_imagen',
            'autorizacion_nna',
            'nacionalidad',
            'ha_participado_anteriormente',
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            'sexo',
            'encuentras_estudiando',
            'ultimo_grado_alcanzado',
            'posee_discapacidad',
            'sede_id',
            'grado_id',
            'seccion_id' ,
            'turno_id',
            //'actividad_club_id' => 'nullable|string|max:100',
            'departamento_id',
            'ciudad_id',
            'sede_departamento_id',
            'sede_ciudad_id',
            'autorizo_participacion'
        );
    }

    
}