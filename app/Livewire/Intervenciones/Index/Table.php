<?php

namespace App\Livewire\Intervenciones\Index;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
//use App\Livewire\Intervenciones\Index\Filters;
use App\Livewire\Intervenciones\Index\Sortable;
use App\Livewire\Intervenciones\Index\Searchable;
use App\Models\Pais;
use App\Models\Intervencion;
use App\Models\EscuelaGWDATA;
use App\Exports\IntervencionesExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Table extends Component
{
    use WithPagination, Searchable, Sortable;

    public $selectedRecordIds = [];

    public $recordsIdsOnPage = [];

    public $selectedFormulario;

    public $perPage = 10;

    public Pais $pais;

    public $codigoPais;

    public $departamentos;
    public $municipios = [];
    public $escuelas = [];

    public $escuelaSelected;
    public $municipioSelected;
    public $departamentoSelected;

    //#[Reactive]
    public Filters $filters;

    #[Renderless]
    public function export()
    {
        if(!auth()->user()->can('Descargar intervenciones directas SM')){
            abort(404);
        }

        return (new IntervencionesExport(
            $this->selectedRecordIds,
            $this->pais,
            $this->filters,
            $this->search,
            $this->sortCol,
            $this->sortAsc,
            $this->escuelaSelected,
            $this->municipioSelected,
            $this->departamentoSelected
            ))
            ->download('intervenciones.xlsx');
    }

    public function mount()
    {
        $user = auth()->user()->load('pais');

        $this->codigoPais = $user->pais->codigo;

        $this->departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($this->codigoPais)->pluck('name', 'fkCodeState');

    }

    public function render()
    {
        $query = Intervencion::with([
            "intervencionParticipante:id,nombres,apellidos,sexo,documento_identidad,codigo_confirmacion,fecha_nacimiento,telefono,email",
            "tipoIntervencion:id,nombre",
            "sede:id,name,code,fkCodeCountry,fkCodeState,fkCodeMunicipality",
            "municipio:id,name,codeMunicipality,fkCodeState",
            "departamento:id,codeState,name,fkCodeCountry",
        ])
            ->where('pais_id', $this->pais->id)
            ->when($this->escuelaSelected && $this->escuelaSelected != "-1", function ($query) {

                return $query->where('sede_id', $this->escuelaSelected);

            })
            ->when($this->municipioSelected, function ($query, $municipioSelected) {

                $escuelas = EscuelaGWDATA::select('id')
                    ->where('fkCodeMunicipality', $municipioSelected)
                    ->get()
                    ->pluck('id')
                    ->toArray();

                return $query->whereIn('sede_id', $escuelas);

            })
            ->when($this->departamentoSelected, function ($query, $departamentoSelected) {

                $escuelas = EscuelaGWDATA::select('id')
                    ->where('fkCodeState', $departamentoSelected)
                    ->get()
                    ->pluck('id')
                    ->toArray();

                return $query->whereIn('sede_id', $escuelas);

            })
            ->orderBy('intervenciones.created_at', 'DESC');

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $query = $this->filters->apply($query);

        $formularios = $query->paginate($this->perPage);

        $this->recordsIdsOnPage = $formularios->map(fn($formulario) => (string) $formulario->id)->toArray();

        return view('livewire.intervenciones.index.table', [
            'formularios' => $formularios,
        ]);
    }

    public function updatedDepartamentoSelected($value)
    {
        $this->municipios = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->codigoPais, $value)->pluck('name', 'codeMunicipality');
    }

    public function updatedMunicipioSelected($value)
    {
        //$this->escuelas = EscuelaGWDATA::getUniqueSchoolsByMunicipality($this->codigoPais, $this->departamentoSelected, $value)->pluck('name', 'code');
        $filteredEscuelas = EscuelaGWDATA::getActiveSchoolsWithComponentAndArea($this->codigoPais, $value);

        $this->escuelas = $filteredEscuelas->pluck("name", "school_id")->toArray();

        // $this->escuelas = [0 => "Todas"] + $escuelas;

        $this->dispatch('refresh-choices-filters', $this->escuelas);
    }

    public function resetSearch()
    {
        $this->reset(['municipios', 'escuelas', 'departamentoSelected', 'municipioSelected', 'escuelaSelected']);
        $this->filters->range = \App\Livewire\Intervenciones\Index\Range::All_Time;

        $this->dispatch('refresh-choices-filters', collect([]));
    }

    public function deleteIntervencion(Intervencion $intervencion)
    {
        if(!auth()->user()->can('Eliminar intervención directa SM')){
            abort(404);
        }

        $intervencion->delete();
        $this->resetPage();
    }

    public function deleteSelected()
    {
        if(!auth()->user()->can('Eliminar intervención directa SM')){
            abort(404);
        }

        Intervencion::whereIn('id', $this->selectedRecordIds)->delete();

        $this->dispatch('update-table-data');

        $this->selectedRecordIds = [];

        $this->showSuccessIndicator = true;

        $this->resetPage();
    }
}
