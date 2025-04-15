<?php

namespace App\Livewire\FRP\Forms;

use App\Livewire\FRP\Traits\InitializeForm;
use App\Livewire\FRP\Traits\WithReferencia;
use App\Livewire\FRP\Traits\WithReferenciaParticipante;
use App\Livewire\FRP\Traits\WithRules;
use App\Livewire\FRP\Traits\WithSeguimiento;
use App\Models\Pais;
use App\Models\Referencia;
use App\Models\ReferenciaParticipante;
use App\Models\ReferenciaSeguimiento;
use Illuminate\Support\Facades\DB;
use Livewire\Form;
use Livewire\WithFileUploads;

class ReferenciaParticipanteForm extends Form
{
    use WithFileUploads, 
        InitializeForm,
        WithRules, 
        WithReferenciaParticipante, 
        WithReferencia,
        WithSeguimiento;

    public Pais $pais;

    public bool $esMenorEdad = false;

    public ReferenciaParticipante $referenciaParticipante;

    public Referencia $referencia;

    public ReferenciaSeguimiento $referenciaSeguimiento;

    public function boot()
    {
        $this->withValidator(function ($validator) {

            if ($validator->fails()) {
              //  dd($validator);
                $this->showValidationErrorIndicator = true;
            }
        });
    }
    public function save() : void
    {
        if( $this->iniciar_proceso_referencia == self::START_REFERENCE_PROCESS_NO ){
            $this->saveNoProcessReference();
        }else{
            $this->saveProcessReference();
        }
    }

    public function saveNoProcessReference()
    {
        $rules = $this->rulesIfNoStartReferenceProcess();

        $this->validate($rules);

        DB::transaction(function() {
            $referencia = new Referencia();
            $referencia->pais_origen_referencia_id = $this->origen_consentimiento_id;
            $referencia->sexo_persona_contacta = $this->sexo_persona_contacta;
            $referencia->fecha_recibe_referencia = $this->fecha_recibe_referencia;
            $referencia->pais_no_acepta_referencia_razon_id = $this->razon_no_acepta_referencia_id;
            $referencia->pais_id = $this->pais->id;

            $referencia->save();
        });
    }

    public function saveProcessReference()
    {
        $rules = $this->rules();

        $this->validate($rules);

        DB::transaction(function() {

            $referenciaParticipante = $this->crearReferenciaParticipante();

            $this->crearReferencia($referenciaParticipante);
            
        });
    }


}