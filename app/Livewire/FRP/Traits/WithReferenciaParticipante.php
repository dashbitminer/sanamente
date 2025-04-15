<?php

namespace App\Livewire\FRP\Traits;

use App\Models\ReferenciaParticipante;
use App\Rules\DocumentoIdentidadRule;

trait WithReferenciaParticipante
{
    // Datos de Identificacion
    public $iniciar_proceso_referencia = null;

    public $nombres;

    public $apellidos;

    public $fecha_nacimiento;

    public $edad;

    public $sexo;

    public $documento_identidad; // ++++

    public $nacionalidad;

    public $telefono; // +++

    public $telefono_familiar;

    public $nombre_persona_responsable; // ---

    public $documento_identidad_persona_responsable; // ---

    public $telefono_persona_responsable; // ---

    public $ciudad_id;

    public $departamento_id;

    public $perfil_participante_id;

    public $posee_discapacidad;

    public $tipo_discapacidad_id;

    public $otras_condiciones_id;

    public $otras_condiciones_otro;

    public function fillReferenciaParticipanteAttr(){
        return [
            'inicia_proceso_referencia' => 1,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'nacionalidad' => $this->nacionalidad,
            'sexo' => $this->sexo,
            'telefono' => $this->telefono,
            'documento_identidad' => $this->documento_identidad,
            'pais_id' => $this->pais->id,
            'ciudad_id' => $this->ciudad_id,
            'departamento_id' => $this->departamento_id,
            'pais_perfil_participante_id' => $this->perfil_participante_id,
            'posee_discapacidad' => $this->posee_discapacidad,
            'pais_tipo_discapacidad_id' => $this->tipo_discapacidad_id,
            'pais_otra_condicion_id' => $this->otras_condiciones_id,
            'otras_condiciones_otro' => $this->otras_condiciones_otro,
            'telefono_familiar' => $this->telefono_familiar,
            'nombre_persona_responsable' => $this->nombre_persona_responsable,
            'documento_identidad_persona_responsable' => $this->documento_identidad_persona_responsable,
            'telefono_persona_responsable' => $this->telefono_persona_responsable,
        ];
    }
    
    public function crearReferenciaParticipante()
    {
        $referenciaParticipante = ReferenciaParticipante::create( 
            $this->fillReferenciaParticipanteAttr() );

        return $referenciaParticipante;
    }

    public function actualizarReferenciaParticipante(ReferenciaParticipante $referenciaParticipante)
    {

        $referenciaParticipante->update( $this->fillReferenciaParticipanteAttr() );

        return $referenciaParticipante;
    }

    public function setReferenciaParticipanteProperties(){
        $this->nombres = $this->referenciaParticipante->nombres;
        $this->apellidos = $this->referenciaParticipante->apellidos;
        $this->fecha_nacimiento = $this->referenciaParticipante->fecha_nacimiento;
        $this->sexo = $this->referenciaParticipante->sexo;
        $this->telefono = $this->referenciaParticipante->telefono;
        $this->nacionalidad = $this->referenciaParticipante->nacionalidad;
        $this->documento_identidad = $this->referenciaParticipante->documento_identidad;
        $this->telefono_familiar = $this->referenciaParticipante->telefono_familiar;
        $this->nombre_persona_responsable = $this->referenciaParticipante->nombre_persona_responsable;
        $this->documento_identidad_persona_responsable = $this->referenciaParticipante->documento_identidad_persona_responsable;
        $this->telefono_persona_responsable = $this->referenciaParticipante->telefono_persona_responsable;
        $this->pais->id = $this->referenciaParticipante->pais_id;
        $this->ciudad_id = $this->referenciaParticipante->ciudad_id;
        $this->departamento_id = $this->referenciaParticipante->departamento_id;
        $this->perfil_participante_id = $this->referenciaParticipante->pais_perfil_participante_id;
        $this->posee_discapacidad = $this->referenciaParticipante->posee_discapacidad;
        $this->tipo_discapacidad_id = $this->referenciaParticipante->pais_tipo_discapacidad_id;
        $this->otras_condiciones_id = $this->referenciaParticipante->pais_otra_condicion_id;
        $this->otras_condiciones_otro = $this->referenciaParticipante->otras_condiciones_otro;
    }
}