<?php

namespace App\Livewire\ClubNNA\Index;

use App\Models\Pais;
use Livewire\Component;
use App\Livewire\ClubNNA\Index\Filters;
use App\Livewire\ClubNNA\Traits\LabelsTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Config;

class Page extends Component
{
    use LabelsTrait;
    public Pais $pais;

    public Filters $filters;

    public $ciudades = [];

    public $escuelas = [];

    public $labels;


    public function mount()
    {
        $user = auth()->user()->load('pais');

        // Set the application's timezone to the user's timezone
        if ($user->timezone) {
            Config::set('app.timezone', $user->timezone);
            date_default_timezone_set($user->timezone);
        }
        $this->pais = $user->pais;
        $this->filters->pais = $this->pais;

        $this->labels = $this->getLabels();

        $this->filters->init();
    }

    #[On('update-table-data')]
    #[Layout('layouts.app')]
    public function render()
    {
        if (!auth()->user()->can('Ver registros club NNA')){
            abort(404);
        }
        
        return view('livewire.club-n-n-a.index.page', [
            'departamentos' => \App\Models\DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)
                                    ->orderBy("name")->pluck("name", "codeState"),
            'ciudades'=> $this->ciudades,
            'escuelas' => $this->escuelas,
        ]);

    }

    public function updated($property, $value)
    {

        if (str_starts_with($property, 'filters.selectedEstadosIds') || $property === 'filters.range') {

            $this->dispatch('manual-reset-page');

        }elseif(str_starts_with( $property, 'filters.departamentosSelected') ){


            $this->ciudades = \App\Models\MunicipioGWDATA::whereIn('fkCodeState', $this->filters->departamentosSelected)
                                    ->orderBy('name')
                                    ->pluck("name", "codeMunicipality");

            $this->escuelas = [];

            $this->dispatch('manual-reset-page');

        }elseif(str_starts_with( $property, 'filters.municipiosSelected') ){

            $this->escuelas =  \App\Models\EscuelaGWDATA::active()
                                    ->whereIn('fkCodeMunicipality', $this->filters->municipiosSelected)
                                    ->where('fkCodeCountry', $this->pais->codigo)
                                    ->orderBy('name')
                                    ->pluck('name', 'id');


            $this->dispatch('manual-reset-page');

        }elseif(str_starts_with( $property, 'filters.escuelasSelected') ){

            $this->dispatch('manual-reset-page');
        }
    }

    public function resetSearch()
    {
        $this->filters->resetFilters();

        $this->dispatch('manual-reset-page');
    }
}
