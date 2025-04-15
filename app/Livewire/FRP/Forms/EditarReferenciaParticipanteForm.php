<?php

namespace App\Livewire\FRP\Forms;

use App\Livewire\FRP\Traits\InitializeForm ;
use App\Livewire\FRP\Traits\WithFormUtility;
use App\Livewire\FRP\Traits\WithReferenciaParticipante;
use App\Livewire\FRP\Traits\WithRules;
use App\Models\MunicipioGWDATA;
use App\Models\Pais;
use App\Models\ReferenciaParticipante;
use Livewire\Form;

class EditarReferenciaParticipanteForm extends Form{
    use InitializeForm,
        WithReferenciaParticipante,
        WithRules,
        WithFormUtility;

    public ReferenciaParticipante $referenciaParticipante;
    
    public Pais $pais;

    public $readonly = false;

    public $esPublico = true;

    public bool $esMenorEdad = false;

    public $showValidationErrorIndicator;

    public function boot()
    {
        $this->withValidator(function ($validator) {

            if ($validator->fails()) {
                $this->showValidationErrorIndicator = true;
            }
        });
    }

    public function setReferenciaParticipante($referenciaParticipante){
        $this->referenciaParticipante = $referenciaParticipante;

    }

    public function setCiudad($departamento_id){
        $this->ciudades = MunicipioGWDATA::where('fkCodeState', $departamento_id)
        ->pluck('name', 'codeMunicipality');
    }

    public function save(){
        $rules = $this->rulesReferenciaParticipante();

        $this->validate($rules);

        \DB::transaction(function(){
            $this->actualizarReferenciaParticipante( $this->referenciaParticipante );
        });
    }

    public function setForm(){
        $this->setReferenciaParticipanteProperties();
    }
}