<?php

namespace App\Livewire\FRP\Forms;

use App\Livewire\FRP\Traits\InitializeForm ;
use App\Livewire\FRP\Traits\WithFormUtility;
use App\Livewire\FRP\Traits\WithReferencia;
use App\Livewire\FRP\Traits\WithReferenciaParticipante;
use App\Livewire\FRP\Traits\WithSeguimiento;
use App\Models\MunicipioGWDATA;
use App\Models\Pais;
use App\Models\Referencia;
use App\Models\ReferenciaParticipante;
use App\Models\ReferenciaSeguimiento;
use Livewire\Form;

class SeguimientoReferenciaParticipanteForm extends Form{
    use InitializeForm,
        WithReferenciaParticipante,
        WithReferencia,
        WithSeguimiento, WithFormUtility;

    public ReferenciaParticipante $referenciaParticipante;

    public Referencia $referencia;

    public ReferenciaSeguimiento $referenciaSeguimiento;

    public Pais $pais;

    public $readonly = false;

    public $esPublico = true;

    public $ciudades;

    public bool $esMenorEdad = false;

    public $dniformat;

    public $duiplaceholder;

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

        $this->referencia = Referencia::where('referencia_participante_id', $this->referenciaParticipante->id)
            ->latest()
            ->firstOrFail();

        $this->referenciaSeguimiento = ReferenciaSeguimiento::firstOrNew(
            ['referencia_id' => $this->referencia->id]
        );

    }

    public function setCiudad($departamento_id){
        $this->ciudades = MunicipioGWDATA::where('fkCodeState', $departamento_id)
        ->pluck('name', 'codeMunicipality');
    }

    public function save(){
        
        $rules = $this->seguimientoRules();

        $this->validate($rules);

        \DB::transaction(function(){
            if( empty($this->referenciaSeguimiento) ){
                $this->referenciaSeguimiento = new ReferenciaSeguimiento();
            }

            $this->referenciaSeguimiento->referencia_id = $this->referencia->id;
            $this->referenciaSeguimiento->ha_recibido_servicio = $this->ha_recibido_servicio;
            $this->referenciaSeguimiento->descripcion = $this->seguimiento_descripcion;
            $this->referenciaSeguimiento->pais_seguimiento_detalle_id = $this->pais_seguimiento_detalle_id;
            $this->referenciaSeguimiento->pais_seguimiento_paso_id = $this->pais_seguimiento_paso_id;
            $this->referenciaSeguimiento->solicita_otra_referencia = $this->solicita_otra_referencia;
            $this->referenciaSeguimiento->comentario = $this->seguimiento_comentario;

            $this->referenciaSeguimiento->save();

        });
    }

    public function setForm(){
        $this->setReferenciaParticipanteProperties();
        $this->setReferenciaProperties();
        $this->setSeguimiento();
    }
}