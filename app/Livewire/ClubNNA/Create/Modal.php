<?php

namespace App\Livewire\ClubNNA\Create;

use App\Livewire\ClubNNA\Forms\ClubNNAForm;
use App\Livewire\ClubNNA\Traits\ClubNNATrait;
use App\Models\ClubNNA;
use App\Models\Pais;
use Livewire\Attributes\On;
use Livewire\Component;
class Modal extends Component{

    use ClubNNATrait;

    public Pais $pais;

    public ClubNNAForm $form;

    public $labels;

    public $data;

    public $openDrawer = false;

    public ClubNNA $clubNNa;

    public bool $showSuccessIndicator = false;

    public function mount()
    {
        $this->data = $this->getData();

        $this->labels = $this->getLabels();

        $this->form->isFastEdit = true;

        $this->form->init($this->pais);
    }


    public function render()
    {
        return view('livewire.club-n-n-a.create.modal', $this->data);
    }

    public function updated($propertyName, $value)
    {

        switch($propertyName)
        {
            case 'form.departamento_id':
                $this->form->ciudades = $this->setCiudad($value);
                break;
            case 'form.sede_departamento_id':
                $this->form->laboraCiudades = $this->setCiudad($value);
                break;
            case 'form.sede_ciudad_id':
                    $this->form->perteneceSede = $this->getSedesEscuelas($value);
                break;
        }
    }

    #[On('openModal')]
    public function openModal($id)
    {
        if (!auth()->user()->can('Editar registro club NNA')){
            abort(404);
        }

        $this->showSuccessIndicator = false;

        $this->openDrawer = true;

        $this->clubNNa = ClubNNA::find($id);

        $this->form->setClubNNa($this->clubNNa);
    }

    public function save()
    {
        if (!auth()->user()->can('Editar registro club NNA')){
            abort(404);
        }

        $this->form->save();

        $this->showSuccessIndicator = true;

        $this->openDrawer = false;

        $this->dispatch('update-table-data');
    }
}
