<?php

namespace App\Livewire\ClubNNA\Create;

use App\Livewire\ClubNNA\Forms\ClubNNAForm;
use App\Livewire\ClubNNA\Traits\ClubNNATrait;
use App\Models\ClubNNA;
use App\Models\Pais;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Page extends Component
{
    use ClubNNATrait;

    public Pais $pais;

    public ClubNNAForm $form;

    public $labels;

    public $data;

    public bool $showSuccessIndicator = false;

    public function mount(?ClubNNA $clubNna)
    {
        $this->data = $this->getData();
        $this->labels = $this->getLabels();

        $this->form->init($this->pais);
        $this->form->setClubNNa($clubNna);

    }

    #[Layout('layouts.club-nna')]
    public function render()
    {
        return view('livewire.club-n-n-a.create.page', $this->data);
    }

    public function save()
    {
        $this->form->save();

        $this->resetForm();
        $this->form->init($this->pais);
        $this->form->setClubNNa(new ClubNNA());

        $this->dispatch('clear-signature:form.signature_responsable', []);
        $this->dispatch('clear-signature:form.signature_nna', []);

        $this->showSuccessIndicator = true;

    }

    public function updated($propertyName, $value)
    {

        switch($propertyName)
        {
            case 'form.departamento_id':
                $this->form->ciudades = $this->setCiudad($value);
                break;
            case 'form.sede_departamento_id':
                $this->form->laboraCiudades = $this->setSedeCiudad($value);
                $this->form->sede_id = '';
                break;
            case 'form.sede_ciudad_id':
                    $this->form->perteneceSede = $this->getSedesEscuelas($value);
                    $this->form->sede_id = '';
                break;
            case 'form.telefono':
                $this->form->telefono = preg_replace('/[^\d]/', '', $value);
                break;
        }
    }
}
