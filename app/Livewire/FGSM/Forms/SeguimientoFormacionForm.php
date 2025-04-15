<?php

namespace App\Livewire\FGSM\Forms;

use Livewire\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\Form;
use App\Models\Pais;
use App\Models\EscuelaGWDATA;
use Illuminate\Validation\Rule;
use App\Models\PerfilSeguimiento;
use App\Rules\DocumentoIdentidadRule;
use App\Models\PerfilSeguimientoSalud;
use App\Models\PerfilSeguimientoPolicia;
use App\Models\SeguimientoFormacionGeneral;
use App\Models\TipoFormulario;
use App\Models\User;

class SeguimientoFormacionForm extends Form
{
    public Pais $pais;

    public SeguimientoFormacionGeneral $seguimiento;

    public $perfilSelected;
    public $perfilSelectedPivot;

    public $perfilDocenteSelected;
    public $perfilDocenteSelectedPivot;

    public $nombres;
    public $apellidos;
    public $documento_identidad;
    public $nacionalidad;
    public $participacion;

    public $perfilPoliciaSelected;
    public $perfilPoliciaSelectedPivot;
    public $rangoPoliciaSelected;
    public $rangoPoliciaSelectedPivot;

    public $perfilOrganizacionSelected;
    public $perfilOrganizacionSelectedPivot;

    public $perfilSaludSelected;
    public $perfilSaludSelectedPivot;

    public $perfilHospitalSelected;
    public $perfilHospitalSelectedPivot;

    public $departamentoSelected;
    public $ciudadSelected;
    public $ciudades;
    public $escuelaSelected;
    public $actividadesSelected;
    public $fecha_participo_actividad;
    public $numero_grupo_participa;


    public $tipoPerfilSaludArray;
    public $tipoPerfilDocente;
    public $tipoPerfilDocenteBasica;
    public $tipoPerfilDocenteSuperior;
    public $tipoPerfilPolicia;
    public $tipoPerfilOrganizaciones;
    public $tipoPerfilSalud;
    public $tipoPerfilPoliciaNacional;

    public $escuelas;

    public $readonly = false;

    public $showValidationErrorIndicator = false;

    public $numero_confirmacion;

    public $formOptions;
    public $perfilesOpt;

    public $dniformat;
    public $duiplaceholder;

    public $mode;

    //public $intervencionistaSelected;

    public $uuid;

    public $email;

    public $user;

    public $createdBy;

    public $disabledPolicia = false;

    public $formador;


    public function rules()
    {
        return [
            'nombres' => [
                'required',
                'min:3',
            ],
            'apellidos' => [
                'required',
                'min:3',
            ],
            // 'intervencionistaSelected' => [
            //     'required',
            // ],
            'fecha_participo_actividad' => [
                'required',
                'date',
            ],
            'nacionalidad' => [
                'required',
            ],
            'participacion' => [
               'required',
            ],
            'documento_identidad' => [
                'required',
                new DocumentoIdentidadRule($this->pais, $this->nacionalidad),
            ],
            'perfilSelected' => [
                'required',
            ],
            'departamentoSelected' => [
                'required',
            ],
            'ciudadSelected' => [
                'required',
            ],
            'actividadesSelected' => [
                'required',
            ],
            'fecha_participo_actividad' => [
                'required',
            ],
            'numero_grupo_participa' => [
                'required',
            ],
            'escuelaSelected' => [
                'required',
            ],
            'perfilDocenteSelected' => [
                Rule::requiredIf(function () {
                    return in_array($this->perfilSelected, $this->tipoPerfilDocente);
                })
            ],
            'perfilOrganizacionSelected' => [
                Rule::requiredIf(function () {
                    return $this->perfilSelected == PerfilSeguimiento::PERFIL_ORGANIZACIONES;
                })
            ],
            'perfilPoliciaSelected' => [
                Rule::requiredIf(function () {
                    return $this->perfilSelected == PerfilSeguimiento::PERFIL_POLICIA;
                })
            ],
            'rangoPoliciaSelected' => [
                Rule::requiredIf(function () {
                    return $this->perfilPoliciaSelected == PerfilSeguimientoPolicia::PERFIL_POLICIA_NACIONAL && $this->perfilSelected == PerfilSeguimiento::PERFIL_POLICIA;
                })
            ],
            'perfilSaludSelected' => [
                Rule::requiredIf(function () {
                    return $this->perfilSelected == PerfilSeguimiento::PERFIL_SALUD;
                })
            ],
            'perfilHospitalSelected' => [
                Rule::requiredIf(function () {
                    return $this->perfilSelected == PerfilSeguimiento::PERFIL_SALUD && in_array($this->perfilSaludSelected, $this->tipoPerfilSaludArray);
                })
            ],

        ];
    }

    public function messages()
    {
        return [
            //'intervencionistaSelected.required' => 'El campo persona que lidera la actividad es requerido.',
            'fecha_participo_actividad.required' => 'El campo fecha de participación en la actividad es requerido.',
            'participacion.required' => 'El campo participación es requerido.',
            'nombres.required' => 'El campo nombres es requerido.',
            'nombres.min' => 'El campo nombres debe de ser de al menos 3 caracteres.',
            'apellidos.required' => 'El campo apellidos es requerido.',
            'apellidos.min' => 'El campo apellidos debe de ser de al menos 3 caracteres.',
            'perfilSelected.required' => 'El campo perfil es requerido.',
            'documento_identidad.required' => 'El campo documento de identidad es requerido.',
            'departamentoSelected.required' => 'El campo departamento es requerido.',
            'ciudadSelected.required' => 'El campo municipio es requerido.',
            'escuelaSelected.required' => 'El campo escuela es requerido.',
            'actividadesSelected.required' => 'El campo actividades es requerido.',
            'numero_grupo_participa.required' => 'El campo número de grupo es requerido.',
            'rangoPoliciaSelected.required' => 'El campo rango es requerido.',
            'perfilDocenteSelected.required' => 'El campo perfil docente es requerido.',
            'perfilOrganizacionSelected.required' => 'El campo perfil organización es requerido.',
            'perfilPoliciaSelected.required' => 'El campo perfil policía es requerido.',
            'nacionalidad.required' => 'El campo nacionalidad es requerido.',
            'fecha_participo_actividad.required' => 'El campo fecha de participación en la actividad es requerido.',
        ];
    }

    public function boot()
    {
        $this->withValidator(function ($validator) {

            if ($validator->fails()) {
                $this->showValidationErrorIndicator = true;
            }
        });
    }

    // const PERFIL_DOCENTE_BASICA = 2;
    // const PERFIL_DOCENTE_SUPERIOR = 3;

    public function init($pais, $uuid, $email)
    {

        $this->pais                      = $pais;
        $this->uuid                      = $uuid;
        $this->email                     = $email;

        $this->user = User::where('uuid', $uuid)
            ->where('email', $email)
            ->firstOrFail();

        $this->createdBy = $this->user->id;

        $this->formador = $this->user->name;

        $this->tipoPerfilDocente         = [PerfilSeguimiento::PERFIL_DOCENTE_BASICA, PerfilSeguimiento::PERFIL_DOCENTE_SUPERIOR];
        $this->tipoPerfilSaludArray      = [PerfilSeguimientoSalud::PERFIL_PERSONAL_HOSPITAL, PerfilSeguimientoSalud::PERFIL_UNIDAD_SALUD];
        $this->tipoPerfilPolicia         = PerfilSeguimiento::PERFIL_POLICIA;
        $this->tipoPerfilOrganizaciones  = PerfilSeguimiento::PERFIL_ORGANIZACIONES;
        $this->tipoPerfilSalud           = PerfilSeguimiento::PERFIL_SALUD;
        $this->tipoPerfilPoliciaNacional = PerfilSeguimientoPolicia::PERFIL_POLICIA_NACIONAL;
        $this->ciudades                  = [];
        $this->actividadesSelected       = [];
        $this->escuelas                  = [];


        $this->fecha_participo_actividad = now()->format('Y-m-d');

        $this->setDuiFormat();

        if($this->pais->id == 2){
            $this->disabledPolicia = true;
        }

    }

    // public function setCreatedByUuid($uuid)
    // {
    //     $user = \App\Models\User::where('uuid', $uuid)->first();
    //     $this->createdBy = $user ? $user->id : NULL;
    // }


    public function setFormulario($formulario)
    {

        $formulario->load([
            "paisPerfilSeguimiento:id,perfil_seguimiento_id",
            "paisPerfilSeguimiento.perfilSeguimiento:id,nombre",
            "paisPerfilSeguimientoDocente:id,perfil_seguimiento_docente_id",
            "paisPerfilSeguimientoDocente.perfilSeguimientoDocente:id,nombre",
            "paisPerfilSeguimientoPolicia:id,perfil_seguimiento_policia_id",
            "paisPerfilSeguimientoPolicia.perfilSeguimientoPolicia:id,nombre",
            "paisRangoSeguimientoPolicia:id,rango_seguimiento_policia_id",
            "paisRangoSeguimientoPolicia.rangoSeguimientoPolicias:id,nombre",
            "paisPerfilSeguimientoSalud:id,perfil_seguimiento_salud_id",
            "paisPerfilSeguimientoSalud.perfilSeguimientoSalud:id,nombre",
            "paisPerfilSeguimientoOrganizacion:id,perfil_seguimiento_organizacion_id",
            "paisPerfilSeguimientoOrganizacion.perfilSeguimientoOrganizacion:id,nombre",
            "paisPerfilSeguimientoHospital:id,perfil_seguimiento_hospital_id",
            "paisPerfilSeguimientoHospital.perfilSeguimientoHospital:id,nombre",
            "paisActividades:id,actividad_seguimiento_id,pais_id",
        ]);

        $this->seguimiento = $formulario;

        $this->nombres = $formulario->nombres;
        $this->apellidos = $formulario->apellidos;
        $this->documento_identidad = $formulario->documento_identidad;
        $this->participacion = $formulario->participacion;
        $this->nacionalidad = $formulario->nacionalidad;

        $this->perfilSelected = $formulario->paisPerfilSeguimiento->perfilSeguimiento->id ?? null;
        $this->perfilSelectedPivot = $formulario->pais_perfil_seguimiento_id;

        $this->perfilDocenteSelected = $formulario->paisPerfilSeguimientoDocente->perfilSeguimientoDocente->id ?? null;
        $this->perfilDocenteSelectedPivot = $formulario->pais_perfil_seguimiento_docente_id;

        $this->perfilPoliciaSelected = $formulario->paisPerfilSeguimientoPolicia->perfilSeguimientoPolicia->id ?? null;
        $this->perfilPoliciaSelectedPivot = $formulario->pais_perfil_seguimiento_policia_id;

        $this->rangoPoliciaSelected = $formulario->paisRangoSeguimientoPolicia->rangoSeguimientoPolicias->id ?? null;
        $this->rangoPoliciaSelectedPivot = $formulario->pais_rango_seguimiento_policia_id;

        $this->perfilOrganizacionSelected = $formulario->paisPerfilSeguimientoOrganizacion->perfilSeguimientoOrganizacion->id ?? null;
        $this->perfilOrganizacionSelectedPivot = $formulario->pais_perfil_seguimiento_organizacion_id;

        $this->perfilSaludSelected = $formulario->paisPerfilSeguimientoSalud->perfilSeguimientoSalud->id ?? null;
        $this->perfilSaludSelectedPivot = $formulario->pais_perfil_seguimiento_salud_id;

        $this->perfilHospitalSelected = $formulario->paisPerfilSeguimientoHospital->perfilSeguimientoHospital->id ?? null;
        $this->perfilHospitalSelectedPivot = $formulario->pais_perfil_seguimiento_hospital_id;

        $this->departamentoSelected = $formulario->departamento_id;
        $this->ciudadSelected = $formulario->ciudad_id;
        $this->escuelaSelected = $formulario->escuela_id;

        $this->numero_grupo_participa = $formulario->numero_grupo_participa;
        $this->actividadesSelected = $formulario->paisActividades->pluck('id')->toArray();
        $this->fecha_participo_actividad = $formulario->fecha_participo_actividad->format('Y-m-d');
        $this->numero_confirmacion = $formulario->codigo_confirmacion;

        $this->ciudades = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->pais->codigo, $this->departamentoSelected)->pluck('name', 'codeMunicipality');

        $filteredEscuelas = EscuelaGWDATA::getActiveSchoolsWithComponentAndArea($this->pais->codigo, $this->ciudadSelected);

        $this->escuelas = $filteredEscuelas->pluck("name", "school_id");

    }


    public function setDuiFormat()
    {
        if ( in_array( $this->pais->id, [1,3]) ) { //Guatemala, Honduras
            $this->dniformat = "9999-9999-99999";
            $this->duiplaceholder = "0000-0000-00000";
        }elseif ($this->pais->id == 2) { // El Salvador
            $this->dniformat = "99999999-9";
            $this->duiplaceholder = "000000000-0";
        }
    }


    public function save(?SeguimientoFormacionGeneral $seguimiento = null)
    {

        if($seguimiento) {
            $this->seguimiento = $seguimiento;
        }

        DB::transaction(function () {

            $this->validate();

            $this->seguimiento->nombres = $this->nombres;
            $this->seguimiento->apellidos = $this->apellidos;
            $this->seguimiento->documento_identidad = $this->documento_identidad;
            $this->seguimiento->participacion = $this->participacion;
            $this->seguimiento->nacionalidad = $this->nacionalidad;

            $this->seguimiento->pais_perfil_seguimiento_id = $this->perfilSelectedPivot;

            $this->seguimiento->ciudad_id = $this->ciudadSelected;
            $this->seguimiento->departamento_id = $this->departamentoSelected;

            $this->seguimiento->pais_id = $this->pais->id;

            $this->seguimiento->numero_grupo_participa = $this->numero_grupo_participa;
            $this->seguimiento->escuela_id = $this->escuelaSelected;

            $this->seguimiento->pais_perfil_seguimiento_docente_id = $this->perfilSelected == PerfilSeguimiento::PERFIL_DOCENTE_BASICA || $this->perfilSelected == PerfilSeguimiento::PERFIL_DOCENTE_SUPERIOR
                ? $this->perfilDocenteSelectedPivot
                : null;

            $this->seguimiento->pais_perfil_seguimiento_organizacion_id = $this->perfilSelected == PerfilSeguimiento::PERFIL_ORGANIZACIONES
                ? $this->perfilOrganizacionSelectedPivot
                : null;

            $this->seguimiento->pais_perfil_seguimiento_policia_id = $this->perfilSelected == PerfilSeguimiento::PERFIL_POLICIA
                ? $this->perfilPoliciaSelectedPivot
                : null;


            $this->seguimiento->pais_rango_seguimiento_policia_id = $this->perfilSelected == PerfilSeguimiento::PERFIL_POLICIA && $this->perfilPoliciaSelected == PerfilSeguimientoPolicia::PERFIL_POLICIA_NACIONAL
                ? $this->rangoPoliciaSelectedPivot
                : null;

            $this->seguimiento->pais_perfil_seguimiento_salud_id = $this->perfilSelected == PerfilSeguimiento::PERFIL_SALUD
                ? $this->perfilSaludSelectedPivot
                : null;

            $this->seguimiento->pais_perfil_seguimiento_hospital_id = $this->perfilSelected == PerfilSeguimiento::PERFIL_SALUD && in_array($this->perfilSaludSelected, $this->tipoPerfilSaludArray)
                ? $this->perfilHospitalSelectedPivot
                : null;


            $this->seguimiento->formulario_id = 1;

            $this->seguimiento->fecha_participo_actividad = $this->fecha_participo_actividad;

            $this->seguimiento->active_at = now();

            $this->seguimiento->save();

            $this->seguimiento->paisActividades()->sync($this->actividadesSelected, ['active_at' => now()]);

            if ($this->mode == "create") {

                if (!$this->numero_confirmacion) {

                    $this->numero_confirmacion = \App\Facades\TicketCode::generateFor($this->seguimiento);

                }

                $this->seguimiento->codigo_confirmacion = $this->numero_confirmacion;

                if (!auth()->check() && $this->createdBy) {

                    $this->seguimiento->created_by = $this->createdBy;

                    $this->seguimiento->updated_by = $this->createdBy;
                }

                $this->seguimiento->save();

                $this->pull(['nombres', 'apellidos', 'documento_identidad', 'perfilSelected', 'perfilSelectedPivot', 'perfilDocenteSelected', 'perfilPoliciaSelected', 'rangoPoliciaSelected', 'perfilOrganizacionSelected', 'perfilSaludSelected', 'perfilHospitalSelected', 'departamentoSelected', 'ciudadSelected', 'escuelaSelected', 'numero_grupo_participa', 'participacion', 'nacionalidad', 'numero_confirmacion']);

                $this->actividadesSelected = [];
            }

        });
    }


    public function autocomplete()
    {
        if ($this->participacion == 2) {
            $latestRecord = SeguimientoFormacionGeneral::with([
                "paisPerfilSeguimiento:id,perfil_seguimiento_id",
                "paisPerfilSeguimiento.perfilSeguimiento:id,nombre",
                "paisPerfilSeguimientoDocente:id,perfil_seguimiento_docente_id",
                "paisPerfilSeguimientoDocente.perfilSeguimientoDocente:id,nombre",
                "paisPerfilSeguimientoPolicia:id,perfil_seguimiento_policia_id",
                "paisPerfilSeguimientoPolicia.perfilSeguimientoPolicia:id,nombre",
                "paisRangoSeguimientoPolicia:id,rango_seguimiento_policia_id",
                "paisRangoSeguimientoPolicia.rangoSeguimientoPolicias:id,nombre",
                "paisPerfilSeguimientoSalud:id,perfil_seguimiento_salud_id",
                "paisPerfilSeguimientoSalud.perfilSeguimientoSalud:id,nombre",
                "paisPerfilSeguimientoOrganizacion:id,perfil_seguimiento_organizacion_id",
                "paisPerfilSeguimientoOrganizacion.perfilSeguimientoOrganizacion:id,nombre",
                "paisPerfilSeguimientoHospital:id,perfil_seguimiento_hospital_id",
                "paisPerfilSeguimientoHospital.perfilSeguimientoHospital:id,nombre"
              ])
                ->where('documento_identidad', $this->documento_identidad)
                ->where('pais_id', $this->pais->id)
                ->latest()
                ->first();

            if ($latestRecord) {

                $this->escuelaSelected = $latestRecord->escuela_id;

                $this->numero_confirmacion = $latestRecord->codigo_confirmacion;

                $this->ciudades = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->pais->codigo, $latestRecord->departamento_id)
                ->pluck('name', 'codeMunicipality');

                $this->ciudadSelected = $latestRecord->ciudad_id;

                $this->nombres = $latestRecord->nombres;
                $this->apellidos = $latestRecord->apellidos;
                $this->perfilSelected = $latestRecord->paisPerfilSeguimiento->perfilSeguimiento->id;
                $this->perfilSelectedPivot = $latestRecord->paisPerfilSeguimiento->id;

                $this->perfilDocenteSelected = $latestRecord->paisPerfilSeguimientoDocente ? $latestRecord->paisPerfilSeguimientoDocente->perfilSeguimientoDocente->id : null;
                $this->perfilDocenteSelectedPivot = $latestRecord->paisPerfilSeguimientoDocente ? $latestRecord->paisPerfilSeguimientoDocente->id : null;

                $this->perfilPoliciaSelected = $latestRecord->paisPerfilSeguimientoPolicia ? $latestRecord->paisPerfilSeguimientoPolicia->perfilSeguimientoPolicia->id : null;
                $this->perfilPoliciaSelectedPivot = $latestRecord->paisPerfilSeguimientoPolicia ? $latestRecord->paisPerfilSeguimientoPolicia->id : null;

                $this->rangoPoliciaSelected = $latestRecord->paisRangoSeguimientoPolicia ? $latestRecord->paisRangoSeguimientoPolicia->rangoSeguimientoPolicias->id : null;
                $this->rangoPoliciaSelectedPivot = $latestRecord->paisRangoSeguimientoPolicia ? $latestRecord->paisRangoSeguimientoPolicia->id : null;

                $this->perfilOrganizacionSelected = $latestRecord->paisPerfilSeguimientoOrganizacion ? $latestRecord->paisPerfilSeguimientoOrganizacion->perfilSeguimientoOrganizacion->id : null;
                $this->perfilOrganizacionSelectedPivot = $latestRecord->paisPerfilSeguimientoOrganizacion ? $latestRecord->paisPerfilSeguimientoOrganizacion->id : null;

                $this->perfilSaludSelected = $latestRecord->paisPerfilSeguimientoSalud ? $latestRecord->paisPerfilSeguimientoSalud->perfilSeguimientoSalud->id : null;
                $this->perfilSaludSelectedPivot = $latestRecord->paisPerfilSeguimientoSalud ? $latestRecord->paisPerfilSeguimientoSalud->id : null;

                $this->departamentoSelected = $latestRecord->departamento_id;

                $this->perfilHospitalSelected = $latestRecord->paisPerfilSeguimientoHospital ? $latestRecord->paisPerfilSeguimientoHospital->perfilSeguimientoHospital->id : null;
                $this->perfilHospitalSelectedPivot = $latestRecord->paisPerfilSeguimientoHospital
                                                    ? $latestRecord->paisPerfilSeguimientoHospital->id
                                                    : null;

            }
        }
    }
}
