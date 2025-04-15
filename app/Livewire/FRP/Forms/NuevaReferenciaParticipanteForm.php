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
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Form;

class NuevaReferenciaParticipanteForm extends Form
{
    use WithFileUploads,
        InitializeForm,
        WithRules,
        WithReferenciaParticipante,
        WithReferencia,
        WithSeguimiento;

    public Pais $pais;
    public ReferenciaParticipante $referenciaParticipante;

    public Referencia $referencia;

    public ReferenciaSeguimiento $referenciaSeguimiento;

    public bool $esMenorEdad = false;

    public function boot()
    {
        $this->withValidator(function ($validator) {

            if ($validator->fails()) {
                $this->showValidationErrorIndicator = true;
            }
        });
    }

    public function save(){
        $rules = $this->rules();

        $this->validate($rules);

        DB::transaction(function() {
            $this->crearReferencia($this->referenciaParticipante);
        });
    }

}