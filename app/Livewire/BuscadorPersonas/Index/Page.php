<?php

namespace App\Livewire\BuscadorPersonas\Index;

use App\Livewire\BuscadorPersonas\Traits\BuscadorTrait;
use App\Models\DepartamentoGWDATA;
use App\Models\EscuelaGWDATA;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Page extends Component
{

    use BuscadorTrait;

    public Filters $filters;

    public $departamentos = [];

    public $municipios = [];

    public $escuelas = [];

    public $subtipos;

    public $codigoUsuarioPais;

    public function mount()
    {
        $user = auth()->user()->load("pais");

        $this->codigoUsuarioPais = $user->pais->codigo;

        $this->filters->paisSelected = $this->codigoUsuarioPais;

        $this->departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($this->filters->paisSelected);

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.buscador-personas.index.page', $this->initializeVariables());
    }


    public function updated($propertyName, $value)
    {
        if($propertyName == 'filters.paisSelected'){
            $this->departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($this->filters->paisSelected);
        }elseif($propertyName == 'filters.departamentoSelected'){
            $this->municipios = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->filters->paisSelected, $this->filters->departamentoSelected);
        }elseif($propertyName == 'filters.municipioSelected'){
            $this->escuelas = EscuelaGWDATA::getActiveSchoolsWithComponentAndArea($this->filters->paisSelected, $this->filters->municipioSelected);
        }elseif($propertyName == 'filters.tipoPersonaSelected'){
            if($this->filters->tipoPersonaSelected != 10){
                $this->filters->subtipoSelected = [];
                $this->subtipos = collect([]);
            }
        }
    }


    public function resetFilters()
    {
        $this->filters->resetFilters();

        $this->departamentos = [];

        $this->municipios = [];

        $this->escuelas = [];

        $this->subtipos = collect([]);

        $this->dispatch('resetFilters');
    }
}
