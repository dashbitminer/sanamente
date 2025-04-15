<?php

namespace App\Livewire\BuscadorPersonas\Index;

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

        if(trim($this->search) === ''){
            return $query;
        }

        $termino = trim($this->search);

        return $query->where(function($query) use ($termino) {
                $query->whereRaw("
                CONCAT(
                    TRIM(COALESCE(beneficiaries.name, '')),
                    IF(TRIM(COALESCE(beneficiaries.surname, '')) != '', CONCAT(' ', TRIM(COALESCE(beneficiaries.surname, ''))), '')
                ) like ?", ['%'.$termino.'%']
                )
                ->orWhere('DNI', 'like', '%'.$termino.'%');
                // ->orWhere('documento_identidad', 'like', '%'.$termino.'%')
                // ->orWhereHas('ciudad', function ($query) use ($termino) {
                //     $query->where('nombre', 'like', '%'.$termino.'%');
                 //});
        });

        // $this->search = trim($this->search);

        // $getSchoolsIds = EscuelaGWDATA::where('fkCodeCountry', $this->pais->codigo)->where('name', 'like', '%'.$this->search.'%')->pluck('id')->toArray();


        // return $query->where(function($query) use ($getSchoolsIds){
        //     $query->where('nombres', 'like', '%'.$this->search.'%')
        //     ->orWhere('apellidos', 'like', '%'.$this->search.'%')
        //     ->orWhere('codigo_confirmacion', 'like', '%'.$this->search.'%')
        //     ->orWhere('documento_identidad', 'like', '%'.$this->search.'%')
        //     ->orWhereIn('escuela_id', $getSchoolsIds)
        //     ->orWhereHas('paisPerfilSeguimiento', function ($query) {
        //         $query->whereHas('perfilSeguimiento', function ($query) {
        //             $query->where('nombre', 'like', '%'.$this->search.'%');
        //         });
        //     });
        // });

       // return

    }

}
