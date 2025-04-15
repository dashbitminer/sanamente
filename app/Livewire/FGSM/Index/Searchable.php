<?php

namespace App\Livewire\FGSM\Index;

use App\Models\EscuelaGWDATA;

trait Searchable
{
    public $search = '';

    public $departamentoSelected;

    public $municipioSelected;

    public $escuelaSelected;


    public function updatedSearchable($property)
    {
        if ($property === 'search') {
            $this->resetPage();
        }
    }

    protected function applySearch($query)
    {
        if($this->search === ''){
            return $query;
        }

        $this->search = trim($this->search);

        $getSchoolsIds = EscuelaGWDATA::where('fkCodeCountry', $this->pais->codigo)->where('name', 'like', '%'.$this->search.'%')->pluck('id')->toArray();


        return $query->where(function($query) use ($getSchoolsIds){
            $query->where('nombres', 'like', '%'.$this->search.'%')
            ->orWhere('apellidos', 'like', '%'.$this->search.'%')
            ->orWhere('codigo_confirmacion', 'like', '%'.$this->search.'%')
            ->orWhere('documento_identidad', 'like', '%'.$this->search.'%')
            ->orWhereIn('escuela_id', $getSchoolsIds)
            ->orWhereHas('paisPerfilSeguimiento', function ($query) {
                $query->whereHas('perfilSeguimiento', function ($query) {
                    $query->where('nombre', 'like', '%'.$this->search.'%');
                });
            });
        });

       // return

    }


    // public function applyDepartamentoFilter($query)
    // {
    //     if (!$this->departamentoSelected) {
    //         return $query;
    //     }

    //     $escuelas = \App\Models\EscuelaGWDATA::select('id')
    //         ->where('fkCodeState', $this->departamentoSelected)
    //         ->get()
    //         ->pluck('id')
    //         ->toArray();

    //     return $query->whereIn('escuela_id', $escuelas);
    // }
}
