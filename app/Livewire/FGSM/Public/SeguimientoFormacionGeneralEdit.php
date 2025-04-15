<?php

namespace App\Livewire\FGSM\Public;

use App\Models\Pais;
use Livewire\Component;
use App\Models\EscuelaGWDATA;
use App\Models\MunicipioGWDATA;
use Livewire\Attributes\Layout;
use App\Models\DepartamentoGWDATA;
use App\Livewire\FGSM\InitializeForm;
use App\Livewire\FGSM\Forms\SeguimientoFormacionForm;
use App\Models\SeguimientoFormacionGeneral as ModelsSeguimientoFormacionGeneral;

class SeguimientoFormacionGeneralEdit extends Component
{
    use InitializeForm;

    public SeguimientoFormacionForm $form;

    public $pais;
    public $seguimiento;
    public $codigo;

    public bool $showSuccessIndicator = false;

    //public $mode = 'edit';


    public function mount(Pais $pais, ModelsSeguimientoFormacionGeneral $id, $codigo)
    {
        $this->pais = $pais;
        $this->seguimiento = $id;
        $this->codigo = $codigo;

        $user = \App\Models\User::find($this->seguimiento->created_by);

        $this->form->init($this->pais, $user->uuid, $user->email);

        $this->form->setFormulario($this->seguimiento);

        $this->form->mode = "edit";
    }

    #[Layout('layouts.seguimiento-formacion-general')]
    public function render()
    {
        return view('livewire.FGSM.Public.seguimiento-formacion-general',  $this->initializeProperties());
    }

    public function save()
    {
        $this->form->save();

        $this->showSuccessIndicator = true;
    }

    public function setEscuelas()  {

        $filteredEscuelas = EscuelaGWDATA::getActiveSchoolsWithComponentAndArea($this->pais->codigo, $this->form->ciudadSelected);

        $this->form->escuelas = $filteredEscuelas->pluck("name", "school_id");

        $this->dispatch('refresh-choices', $this->form->escuelas);
    }
}
