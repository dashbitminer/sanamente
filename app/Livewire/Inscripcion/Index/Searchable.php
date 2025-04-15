<?php

namespace App\Livewire\Inscripcion\Index;

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
        if ($this->search === '') {
            return $query;
        }

        //$this->search = trim($this->search);
        $value = "%{$this->search}%";

        return $query->where(function (Builder $builder) use ($value) {
            $builder->whereLike('codigo_confirmacion', $value)
                ->orWhereLike('documento_identidad', $value)
                ->orWhereLike('nombres', $value)
                ->orWhereLike('apellidos', $value);
        });

    }
}
