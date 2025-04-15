<?php
namespace App\Livewire\FRP\Edit;

use App\Livewire\FRP\Forms\EditarReferenciaParticipanteForm;
use App\Livewire\FRP\Traits\WithFormUtility;
use App\Models\Pais;
use App\Models\ReferenciaParticipante;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Page extends Component {
    use WithFormUtility;
    public EditarReferenciaParticipanteForm $form;

    public ReferenciaParticipante $referenciaParticipante;

    public bool $showSuccessIndicator = false;

    public Pais $pais;

    public $edad;

    public $nombreCompleto;

    public function mount(){
        $user = auth()->user()->load('pais');
        if ($user->timezone) {
            Config::set('app.timezone', $user->timezone);
            date_default_timezone_set($user->timezone);
        }

        $this->pais = $user->pais;
        $this->form->iniciar_proceso_referencia = 1;
        $this->form->esPublico = true;
        
        $this->form->esMenorEdad = $this->esMenorDeEdad();
        $this->form->setReferenciaParticipante($this->referenciaParticipante);
        $this->form->init($this->pais);
        $this->form->setForm();
        $this->form->setCiudad($this->form->departamento_id);
    }

    #[Layout('layouts.registro-participante-general')]
    public function render()
    {
        if(!auth()->user()->can('Editar referencia RSAC')){
            abort(404);
        }
        return view('livewire.FRP.edit.page', $this->form->getData());
    }

    public function save()
    {
        $this->form->save();
        $this->showSuccessIndicator = true;

        sleep(1);

        return redirect()->route('admin.frp.index', [
            'edad' => $this->edad,
        ]);
    }

    public function esMenorDeEdad(){
        return $this->edad == 'menor';
    }
}