<?php

namespace App\Livewire\FGSM\Index;

use App\Models\Pais;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
use App\Livewire\FGSM\Index\Filters;
use App\Livewire\FGSM\Index\Sortable;
use App\Livewire\FGSM\Index\Searchable;
use App\Exports\SeguimientoFormacionExport;
use App\Models\EscuelaGWDATA;
use App\Models\SeguimientoFormacionGeneral;

class Table extends Component
{
    use WithPagination, Searchable, Sortable;

    public $selectedRecordIds = [];

    public $recordsIdsOnPage = [];

    public $selectedFormulario;

    public $perPage = 10;

    public Pais $pais;

    public $codigoPais;

    public $paises = [];
    public $departamentos;
    public $municipios = [];
    public $escuelas = [];

    public $escuelaSelected;
    public $municipioSelected;
    public $departamentoSelected;
    public $paisSelected;



    // #[Reactive]
    public Filters $filters;

    #[Renderless]
    public function export()
    {
        if (!auth()->user()->can('Descargar seguimientos FGSM')){
            abort(404);
        }

        return (new SeguimientoFormacionExport($this->selectedRecordIds,  $this->pais))->download('seguimiento_formacion.xlsx');
    }


    public function mount()
    {
        $user = auth()->user()->load('pais');

        $this->codigoPais = $user->pais->codigo;

        $this->departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($this->codigoPais)->pluck('name', 'fkCodeState');

        if($user->hasPermissionTo('Acceso total')){
            $this->paises = Pais::all()->pluck('nombre', 'codigo');
            $this->paisSelected = $user->pais->codigo;
        }

    }

    public function render()
    {
        $query = SeguimientoFormacionGeneral::with([
            "paisPerfilSeguimiento:id,perfil_seguimiento_id,pais_id",
            "paisPerfilSeguimiento.perfilSeguimiento:id,nombre",
            "escuela:id,name,code,fkCodeCountry,fkCodeState,fkCodeMunicipality",
            "escuela.municipio:id,name,codeMunicipality,fkCodeState",
            "escuela.departamento:id,codeState,name,fkCodeCountry",
            "creator:id,name,pais_id",
        ])
        ->when($this->escuelaSelected && $this->escuelaSelected != "-1", function ($query) {

            return $query->where('escuela_id', $this->escuelaSelected);

        })
        ->when($this->municipioSelected, function ($query, $municipioSelected) {

            $escuelas = EscuelaGWDATA::select('id')
                ->where('fkCodeMunicipality', $municipioSelected)
                ->get()
                ->pluck('id')
                ->toArray();

            return $query->whereIn('escuela_id', $escuelas);

        })
        ->when($this->departamentoSelected, function ($query, $departamentoSelected) {

            $escuelas = EscuelaGWDATA::select('id')
                ->where('fkCodeState', $departamentoSelected)
                ->get()
                ->pluck('id')
                ->toArray();

            return $query->whereIn('escuela_id', $escuelas);

        })
        ->when($this->paisSelected, function ($query, $paisSelected) {

            $paisSelected = Pais::where('codigo', $paisSelected)->pluck('id');

            return $query->whereIn('pais_id', $paisSelected);

        });


        if(auth()->user()->hasPermissionTo('Acceso a sus formularios')){
            $query = $query->where('seguimiento_formacion_generales.created_by', auth()->user()->id);
        }elseif(auth()->user()->hasPermissionTo('Acceso total de su pais')){
            $query = $query->whereHas('creator', function ($query) {
                $query->where('users.pais_id', auth()->user()->pais_id);
            });
        }elseif(auth()->user()->hasPermissionTo('Acceso total')){
            $query = $query;
        }else{
          //  $query = $query->where('pais_id', $this->pais->id);
        }


        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $query = $this->filters->apply($query);

        $formularios = $query->paginate($this->perPage);

        $this->recordsIdsOnPage = $formularios->map(fn($formulario) => (string) $formulario->id)->toArray();

        return view('livewire.FGSM.index.table', [
            'formularios' => $formularios,
        ]);
    }


    public function updatedPaisSelected($value)
    {
        $this->departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($value)->pluck('name', 'fkCodeState');
    }

    public function updatedDepartamentoSelected($value)
    {
        $this->municipios = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->codigoPais, $value)->pluck('name', 'codeMunicipality');
    }

    public function updatedMunicipioSelected($value)
    {
        $filteredEscuelas = EscuelaGWDATA::getActiveSchoolsWithComponentAndArea($this->codigoPais, $value);

        $this->escuelas = $filteredEscuelas->pluck("name", "school_id")->toArray();

        $this->dispatch('refresh-choices-filters', $this->escuelas);
    }

    public function resetSearch()
    {
        $this->reset(['municipios', 'escuelas', 'departamentoSelected', 'municipioSelected', 'escuelaSelected']);

        $this->dispatch('refresh-choices-filters', collect([]));
    }

    public function deleteSelected()
    {
        if (!auth()->user()->can('Eliminar seguimiento FGSM')){
            abort(403);
        }

        SeguimientoFormacionGeneral::whereIn('id', $this->selectedRecordIds)->delete();

        $this->selectedRecordIds = [];
    }
}
