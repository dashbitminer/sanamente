<?php

namespace App\Livewire\FRP\Create;

use App\Livewire\FRP\Forms\ReferenciaParticipanteForm;
use App\Livewire\FRP\Traits\WithFormUtility;
use App\Models\Pais;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Livewire;
use Livewire\WithFileUploads;

class Page extends Component
{

    use WithFileUploads, WithFormUtility;

    public ReferenciaParticipanteForm $form;

    public Pais $pais;

    public bool $showSuccessIndicator = false;

    public $edad;

    public $nombreCompleto;

    public $codigo_confirmacion;


    public function mount(){
        $this->form->init($this->pais);
        $this->form->esMenorEdad = $this->esMenorDeEdad();

        if($this->form->esMenorEdad)
            $this->form->nacionalidad = $this->form::NACIONAL;
    }

    #[Layout('layouts.registro-participante-general')]
    public function render()
    {
        return view('livewire.FRP.create.page', $this->form->getData());
    }

    public function save()
    {
        $this->form->save();
        $this->showSuccessIndicator = true;

        $this->codigo_confirmacion = $this->form->codigo_confirmacion;

        $this->form->resetForm();

        /** Clear Signature */
        $this->dispatch('clear-signature:form.signature_persona', []);
        $this->dispatch('clear-signature:form.signature_autoriza_adulto', []);

        /** Clear Choice  */
        $this->dispatch('deselect-all-form.accion_inmediata_id', []);
        $this->dispatch('deselect-all-form.motivo_referencia_id', []);
        $this->dispatch('deselect-all-form.tipo_violencia_id', []);
        $this->dispatch('deselect-all-form.tipo_servicio_id', []);        
    }

    public function esMenorDeEdad(){
        return $this->edad == 'menor';
    }
}