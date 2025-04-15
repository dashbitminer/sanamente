<?php

namespace App\Livewire\FGSM;


use App\Models\Ciudad;
use App\Models\DepartamentoGWDATA;
use App\Models\EscuelaGWDATA;
use Illuminate\Support\Facades\DB;
use App\Models\SeguimientoFormacionGeneral as ModelsSeguimientoFormacionGeneral;


trait InitializeForm
{

    public function initializeProperties()  {

        $perfiles = $this->pais->perfilesSeguimiento()->whereNotNull("perfil_seguimientos.active_at")
                    ->select("perfil_seguimientos.nombre", "perfil_seguimientos.id", "pais_perfil_seguimientos.id as pivotid")
                    ->get();

        $perfilDocente = $this->pais->perfilesSeguimientoDocente()->whereNotNull("perfil_seguimiento_docentes.active_at")
                        ->select("perfil_seguimiento_docentes.nombre", "perfil_seguimiento_docentes.id", "pais_perfil_seguimiento_docentes.id as pivotid")
                        ->get();



        $perfilPolicia = $this->pais->perfilesSeguimientoPolicia()->whereNotNull("perfil_seguimiento_policias.active_at")->select("perfil_seguimiento_policias.nombre", "perfil_seguimiento_policias.id", "pais_perfil_seguimiento_policias.id as pivotid")->get();

        $rangoPolicia = $this->pais->rangoPerfilesSeguimientoPolicia()->whereNotNull("rango_seguimiento_policias.active_at")->select("rango_seguimiento_policias.nombre", "rango_seguimiento_policias.id", "pais_rango_seguimiento_policias.id as pivotid")->get();

        $perfilOrganizaciones = $this->pais->perfilesSeguimientoOrganizacion()->whereNotNull("perfil_seguimiento_organizaciones.active_at")->select("perfil_seguimiento_organizaciones.nombre", "perfil_seguimiento_organizaciones.id", "pais_perfil_seguimiento_organizaciones.id as pivotid")->get();

        $perfilSalud = $this->pais->perfilesSeguimientoSalud()->whereNotNull("perfil_seguimiento_salud.active_at")->select("perfil_seguimiento_salud.nombre", "perfil_seguimiento_salud.id", "pais_perfil_seguimiento_salud.id as pivotid")->get();

        $perfilHospital = $this->pais->perfilesSeguimientoHospital()->whereNotNull("perfil_seguimiento_hospitales.active_at")->select("perfil_seguimiento_hospitales.nombre", "perfil_seguimiento_hospitales.id", "pais_perfil_seguimiento_hospitales.id as pivotid")->get();

        $departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($this->pais->codigo)->pluck('name', 'fkCodeState');

        $actividades = $this->pais->actividadesSeguimiento()->whereNotNull("actividad_seguimientos.active_at")->pluck("actividad_seguimientos.nombre", "pais_actividad_seguimientos.id");

        $intervencionistas = $this->pais->intervencionistas()->whereNotNull("intervencionistas.active_at")->pluck("nombre", "id");

        return [
            'perfiles' => $perfiles,
            'perfilDocente' => $perfilDocente,
            'perfilPolicia' => $perfilPolicia,
            'rangoPolicia' => $rangoPolicia,
            'perfilOrganizaciones' => $perfilOrganizaciones,
            'perfilSalud' => $perfilSalud,
            'perfilHospital' => $perfilHospital,
            'departamentos' => $departamentos,
            'actividades' => $actividades,
            'intervencionistas' => $intervencionistas,
        ];
    }


    public function updated($propertyName, $value)
    {

       // dump($propertyName, $value);

        if(str($propertyName)->startsWith('form.departamentoSelected')) {
            $this->form->ciudadSelected = null;
            $this->form->escuelaSelected = null;
            $this->form->ciudades = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->pais->codigo, $value)->pluck('name', 'codeMunicipality');
            $this->dispatch('refresh-choices', []);
        }elseif(str($propertyName)->startsWith('form.perfilSelected')) {
            $this->form->perfilDocenteSelected = null;
            $this->form->perfilPoliciaSelected = null;
            $this->form->rangoPoliciaSelected = null;
            $this->form->perfilSaludSelected = null;
            $this->form->perfilHospitalSelected = null;
        } elseif(str($propertyName)->startsWith('form.ciudadSelected')){
             $this->setEscuelas();
        } elseif(str($propertyName)->exactly('form.documento_identidad')){
            $this->form->autocomplete();
            $this->setEscuelas();
        } elseif(str($propertyName)->startsWith('form.nacionalidad')){
            if ($value == ModelsSeguimientoFormacionGeneral::EXTRANJERO) {
                $this->form->dniformat = "";
                $this->form->duiplaceholder = "";
            }else{
                $this->form->setDuiFormat();
            }

        } elseif(str($propertyName)->exactly('form.participacion')) {
            if ($value == 2 && $this->form->documento_identidad) {
                $this->form->autocomplete();
                $this->setEscuelas();
            }
        }
    }

}
