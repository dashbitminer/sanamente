<?php

namespace App\Livewire\FRP\Index;

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

        return $query->where(function ($q) {
            $q->where('nombres', 'like', '%' . $this->search . '%')
              ->orWhere('apellidos', 'like', '%' . $this->search . '%')
              ->orWhere('documento_identidad', 'like', '%'.$this->search.'%');
        });

    }
}
