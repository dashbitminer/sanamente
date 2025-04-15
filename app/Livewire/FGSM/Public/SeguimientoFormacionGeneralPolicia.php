<?php

namespace App\Livewire\FGSM\Public;

use App\Models\Pais;
use Livewire\Component;
use App\Models\EscuelaGWDATA;
use App\Models\MunicipioGWDATA;
use Livewire\Attributes\Layout;
use App\Models\DepartamentoGWDATA;
use App\Livewire\FGSM\InitializeForm;
use Illuminate\Support\Facades\abort;
use App\Livewire\FGSM\Forms\SeguimientoFormacionForm;
use App\Livewire\FGSM\Forms\SeguimientoFormacionPoliciaForm;
use App\Models\SeguimientoFormacionGeneral as ModelsSeguimientoFormacionGeneral;


class SeguimientoFormacionGeneralPolicia extends Component
{
    use InitializeForm;

    public SeguimientoFormacionPoliciaForm $form;

    public Pais $pais;

    public $uuid;

    public $email;

    public bool $showSuccessIndicator = false;


    public function setEscuelas()  {

        $filteredEscuelas = EscuelaGWDATA::getActiveSchoolsWithComponentAndArea($this->pais->codigo, $this->form->ciudadSelected);

        $this->form->escuelas = $filteredEscuelas->pluck("name", "school_id");

        $this->dispatch('refresh-choices', $this->form->escuelas);
    }

    public function mount($pais, $uuid, $email)
    {
        if ($this->pais->id != 2) {
            abort(404, 'Pais not found');
        }

        $this->pais = $pais;

        $this->uuid = $uuid;

        $this->email = $email;

        $this->form->init($this->pais, $this->uuid, $this->email);

        $this->form->mode = "create";
    }

    #[Layout('layouts.seguimiento-formacion-general')]
    public function render()
    {
        return view('livewire.FGSM.Public.seguimiento-formacion-general-policia',  $this->initializeProperties());
    }

    public function save()
    {
        $this->form->save(new ModelsSeguimientoFormacionGeneral());

        $this->form->escuelas = collect([]);

        $this->dispatch('refresh-choices', $this->form->escuelas);

        $this->showSuccessIndicator = true;
    }
}
