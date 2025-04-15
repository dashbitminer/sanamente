<?php

namespace App\Livewire\Inscripcion\Index;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Pais;
use App\Models\Inscripcion;
use App\Models\DepartamentoGWDATA;
use App\Models\MunicipioGWDATA;
use App\Models\EscuelaGWDATA;

class Page extends Component
{
    public Pais $pais;

    public Filters $filters;

    public $ciudades = [];

    public $escuelas = [];

    public $departamentosUnicos;

    public $ciudadesUnicas;

    public $sedeUnicas;

    public function mount()
    {
        $user = auth()->user()->load('pais');

        // Set the application's timezone to the user's timezone
        if ($user->timezone) {
            Config::set('app.timezone', $user->timezone);
            date_default_timezone_set($user->timezone);
        }

        $this->pais = $user->pais;
        $this->filters->init($this->pais);

        $this->departamentosUnicos = $this->getUniqueAddress('pertenece_departamento_id');
        $this->ciudadesUnicas = $this->getUniqueAddress('pertenece_ciudad_id');
        $this->sedeUnicas = $this->getUniqueAddress('pertenece_sede_id');

        $this->resetCiudades();

        $this->resetSedes();
    }

    #[On('update-table-data')]
    #[Layout('layouts.app')]
    public function render()
    {
        if (!auth()->user()->can('Ver inscripción formaciones SM')){
            abort(404);
        }

        return view('livewire.inscripcion.index.page', [
            'departamentos' => DepartamentoGWDATA::where('fkCodeCountry', $this->pais->codigo)
                                    ->when($this->departamentosUnicos, function ($query) {
                                        $query->whereIn('codeState', $this->departamentosUnicos);
                                    })
                                    ->orderBy("name")
                                    ->pluck("name", "codeState"),
        ]);
    }

    public function updated($property, $value)
    {

        if (str_starts_with($property, 'filters.selectedEstadosIds') || $property === 'filters.range') {

            $this->dispatch('manual-reset-page');

        }elseif(str_starts_with( $property, 'filters.departamentosSelected') ){
            $this->filters->municipiosSelected = [];
            $this->filters->escuelasSelected = [];
            $this->escuelas = [];

            $this->ciudades = MunicipioGWDATA::whereIn('fkCodeState', $this->filters->departamentosSelected)
                                    ->orderBy('name')
                                    ->pluck("name", "codeMunicipality");

            // Filtrar solo por ciudades que tengan inscripciones
            if ($this->ciudades->count()) {
                $this->ciudades = $this->ciudades->filter(function ($value, $key) {
                    return array_search($key, $this->ciudadesUnicas);
                });
            }
            else {
                $this->resetCiudades();
                $this->resetSedes();
            }

            $this->dispatch('manual-reset-page');

        }elseif(str_starts_with( $property, 'filters.municipiosSelected') ){

            $this->escuelas =  EscuelaGWDATA::active()
                                    ->whereIn('fkCodeMunicipality', $this->filters->municipiosSelected)
                                    ->where('fkCodeCountry', $this->pais->codigo)
                                    ->orderBy('name')
                                    ->pluck('name', 'id');

            // Filtra solo por escuelas que tengan inscripciones
            if ($this->escuelas->count()) {
                $this->escuelas = $this->escuelas->filter(function ($value, $key) {
                    return array_search($key, $this->sedeUnicas);
                });
            }

            $this->dispatch('manual-reset-page');

        }elseif(str_starts_with( $property, 'filters.escuelasSelected') ){

            $this->dispatch('manual-reset-page');
        }
    }

    public function resetSearch()
    {
        $this->filters->resetFilters();

        $this->resetCiudades();

        $this->resetSedes();

        $this->dispatch('manual-reset-page');
    }

    public function resetCiudades()
    {
        if ($this->ciudadesUnicas) {
            $this->ciudades = MunicipioGWDATA::whereIn('codeMunicipality', $this->ciudadesUnicas)
                ->orderBy('name')
                ->pluck("name", "codeMunicipality");
        }
    }

    public function resetSedes()
    {
        if ($this->sedeUnicas) {
            $this->escuelas =  EscuelaGWDATA::whereIn('id', $this->sedeUnicas)
                ->where('fkCodeCountry', $this->pais->codigo)
                ->orderBy('name')
                ->pluck('name', 'id');
        }
    }

    public function getUniqueAddress($column)
    {
        return Inscripcion::select($column)
            ->distinct()
            ->get()
            ->pluck($column)
            ->toArray();
    }
}
