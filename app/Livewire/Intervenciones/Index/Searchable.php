<?php

namespace App\Livewire\Intervenciones\Index;

use Illuminate\Database\Eloquent\Builder;
use App\Models\EscuelaGWDATA;

trait Searchable
{
    public $search = '';

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

        // $sedes = EscuelaGWDATA::where('fkCodeCountry', $this->pais->codigo)
        //     ->where('scs.tipoEntidad', EscuelaGWDATA::TIPO_ENTIDAD_SEDE)
        //     ->where('name', 'like', '%'.$this->search.'%')
        //     ->pluck('id')
        //     ->toArray();

        return $query->where(function (Builder $builder) {
            $builder->where('codigo_confirmacion', 'like', '%'.$this->search.'%')
                ->orWhereHas('intervencionParticipante', function ($subquery) {
                    $subquery->where('nombres', 'like', '%'.$this->search.'%')
                        ->orWhere('apellidos', 'like', '%'.$this->search.'%')
                        ->orWhere('documento_identidad', 'like', '%'.$this->search.'%')
                        ->orWhere('codigo_confirmacion', 'like', '%'.$this->search.'%');
                });
        });

    }
}
