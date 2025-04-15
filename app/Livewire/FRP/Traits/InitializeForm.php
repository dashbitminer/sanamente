<?php

namespace App\Livewire\FRP\Traits;

use App\Models\DepartamentoGWDATA;
use App\Models\EscuelaGWDATA;
use App\PhoneLength;

trait InitializeForm
{
    const NACIONAL = 1;
    
    const EXTRANJERO = 2;

    const START_REFERENCE_PROCESS_YES = 1;
    
    const START_REFERENCE_PROCESS_NO = 0;

    public $dniformat;

    public $duiplaceholder;

    public $signature_persona;

    public $signature_autoriza_adulto;

    public $ciudades;

    public $mayorEdad = 18;

    public $readonly = false;

    public $esPublico = true;

    public $showValidationErrorIndicator;

    public $telephone_length;

    public function init($pais)
    {
        $this->ciudades = [];
        $this->pais = $pais;

        $this->setDuiFormat();

        $this->telephone_length = match($this->pais->slug) {
            'mexico' => PhoneLength::MEXICO,
            'guatemala' => PhoneLength::GUATEMALA,
            'el-salvador' => PhoneLength::EL_SALVADOR,
            'pnc' => PhoneLength::PNC,
            'honduras' => PhoneLength::HONDURAS,
            'costa-rica' => PhoneLength::COSTA_RICA,
            'panama' => PhoneLength::PANAMA,
            'colombia' => PhoneLength::COLOMBIA,
            default => PhoneLength::GUATEMALA,
        };
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
    
    public function getData(): array
    {
        /*$departamentos = DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)
            ->pluck('name', 'codeState');*/
        
        $departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($this->pais->codigo)
            ->pluck('name', 'fkCodeState');

        $perfilParticipante = $this->pais->perfilParticipante()
            ->whereNotNull('perfil_participantes.active_at')
            ->pluck('perfil_participantes.nombre', 'pais_perfil_participantes.id');

        $discapacidades = $this->pais->tipoDiscapacidad()
            ->whereNotNull('tipo_discapacidades.active_at')
            ->pluck('tipo_discapacidades.nombre', 'pais_tipo_discapacidades.id');

        $otrasCondiciones = $this->pais->otraCondicion()
            ->whereNotNull('otra_condiciones.active_at')
            ->pluck('otra_condiciones.nombre', 'pais_otra_condiciones.id');

        $accionInmediatas = $this->pais->accionInmediata()
            ->whereNotNull('accion_inmediatas.active_at')
            ->pluck('accion_inmediatas.nombre', 'pais_accion_inmediatas.id');

        $motivoReferencias = $this->pais->motivoReferencia()
            ->whereNotNull('motivo_referencias.active_at')
            ->pluck('motivo_referencias.nombre', 'pais_motivo_referencias.id');

        $tipoViolencias = $this->pais->tipoViolencia()
            ->whereNotNull('tipo_violencias.active_at')
            ->pluck('tipo_violencias.nombre', 'pais_tipo_violencias.id');

        $tipoServicios = $this->pais->tipoServicio()
            ->whereNotNull('tipo_servicios.active_at')
            ->pluck('tipo_servicios.nombre', 'pais_tipo_servicios.id');

        $tipoServiciosSaludMental = $this->pais->saludMentalServicio()
            ->whereNotNull('salud_mental_servicios.active_at')
            ->pluck('salud_mental_servicios.nombre', 'pais_salud_mental_servicios.id');
        
        $instituciones = $this->pais->institucionReferencia()
            ->whereNotNull('institucion_referencias.active_at')
            ->pluck('institucion_referencias.nombre', 'pais_institucion_referencias.id');

        $parametrosUrgencias = $this->pais->urgenciaReferenciaParametro()
            ->whereNotNull('urgencia_referencia_parametros.active_at')
            ->pluck('urgencia_referencia_parametros.nombre', 'pais_urgencia_referencia_parametros.id');
        
        $modalidadConsentimientos = $this->pais->ModalidadConsentimiento()
            ->whereNotNull('modalidad_consentimientos.active_at')
            ->pluck('modalidad_consentimientos.nombre', 'pais_modalidad_consentimientos.id');

        $origenConsentimiento = $this->pais->origenReferencia()
        ->whereNotNull('origen_referencias.active_at')
        ->pluck('origen_referencias.nombre', 'pais_origen_referencias.id');

        $razonNoAceptaReferencias = $this->pais->noAceptaReferenciaRazon()
            ->whereNotNull('no_acepta_referencia_razones.active_at')
            ->pluck('no_acepta_referencia_razones.nombre', 'pais_no_acepta_referencia_razones.id');

        $seguimientoDetalles = $this->pais->seguimientoDetalle()
            ->whereNotNull('seguimiento_detalles.active_at')
            ->pluck('seguimiento_detalles.nombre', 'pais_seguimiento_detalles.id');

        $seguimientoPasos = $this->pais->seguimientoPaso()
            ->whereNotNull('seguimiento_pasos.active_at')
            ->pluck('seguimiento_pasos.nombre', 'pais_seguimiento_pasos.id');

        return [
            'departamentos' => $departamentos,
            'perfil_participante' => $perfilParticipante,
            'discapacidades' => $discapacidades,
            'otras_condiciones' => $otrasCondiciones,
            'accion_inmediatas' => $accionInmediatas,
            'motivo_referencias' => $motivoReferencias,
            'tipo_violencias' => $tipoViolencias,
            'tipo_servicios' => $tipoServicios,
            'tipo_servicios_salud_mental' => $tipoServiciosSaludMental,
            'instituciones' => $instituciones,
            'parametros_urgencias' => $parametrosUrgencias,
            'modalidad_consentimientos' => $modalidadConsentimientos,
            'origen_consentimientos' => $origenConsentimiento,
            'razon_no_acepta_referencias' => $razonNoAceptaReferencias,
            'seguimiento_detalles' => $seguimientoDetalles,
            'seguimiento_pasos' => $seguimientoPasos,
        ];
    }

    public function isMayorEdad() : bool
    {
        return !$this->esMenorEdad;
    }

    public function isMenorEdad() : bool
    {
        return $this->esMenorEdad;
    }

    public function resetForm()
    {
        $this->reset(
            'nombres',
            'apellidos',
            'fecha_nacimiento',
            'sexo',
            'nacionalidad',
            'documento_identidad',
            'telefono',
            'departamento_id',
            'ciudad_id',
            'nombre_persona_responsable',
            'documento_identidad_persona_responsable',
            'telefono_persona_responsable',
            'telefono_familiar',
            'perfil_participante_id',
            'posee_discapacidad',
            'tipo_discapacidad_id',
            'otras_condiciones_id',
            'otras_condiciones_otro',
            'fecha_registro',
            'accion_inmediata_id',
            'accion_inmediata_otro',
            'motivo_referencia_id',
            'tipo_violencia_id',
            'motivo_referencia_otro',
            'comentarios',
            'activacion_protocolos',
            'documento_protocolos',
            'tipo_servicio_id',
            'tipo_servicio_otra',
            'institucion_refiere_id',
            'parametro_urgencia_id',
            'modalid_consentimiento_id',
            'autorizacion_persona_adulta',
            'documento_consentimientos',
            'acepta_referencia',
            'autoriza_adulto',
            'origen_consentimiento_id',
            'sexo_persona_contacta',
            'fecha_recibe_referencia',
            'razon_no_acepta_referencia_id',
        );
    }
    
}