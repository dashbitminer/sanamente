<?php
namespace App\Livewire\FRP\Create;

use App\Livewire\FRP\Forms\NuevaReferenciaParticipanteForm;
use App\Livewire\FRP\Traits\WithFormUtility;
use App\Models\Pais;
use App\Models\ReferenciaParticipante;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class NuevaReferenciaParticipante extends Component
{

    use WithFileUploads, WithFormUtility;

    public NuevaReferenciaParticipanteForm $form;

    public Pais $pais;

    public ReferenciaParticipante $referenciaParticipante;

    public bool $showSuccessIndicator = false;

    public $edad;

    public $nombreCompleto;

    public $codigo_confirmacion;

    public function mount(){
        $this->form->referenciaParticipante = $this->referenciaParticipante;
        $this->form->iniciar_proceso_referencia = $this->form::START_REFERENCE_PROCESS_YES;

        $this->form->init($this->pais);
        $this->form->esMenorEdad = $this->esMenorDeEdad();
        $this->form->setReferenciaParticipanteProperties();
    }

    #[Layout('layouts.registro-participante-general')]
    public function render()
    {
        return view('livewire.FRP.create.nueva-referencia', $this->form->getData());
    }

    public function save()
    {
        $this->form->save();
        $this->showSuccessIndicator = true;

        $this->codigo_confirmacion = $this->form->codigo_confirmacion;

        $this->form->resetForm();

        $this->dispatch('clear-signature:form.signature_persona', []);
        $this->dispatch('clear-signature:form.signature_autoriza_adulto', []);
    }

    public function esMenorDeEdad(){
        return $this->edad == 'menor';
    }
}