<?php

namespace App\Livewire\Inscripcion\Index;

use Livewire\Attributes\Url;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PersonalInstitucionalGWDATA;

trait Sortable
{
    #[Url]
    public $sortCol;

    #[Url]
    public $sortAsc = false;


    public function updatedSortable($property)
    {
        if ($property === 'sortCol') {
            $this->resetPage();
        }
    }

    public function sortBy($column)
    {
        if ($this->sortCol === $column) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortCol = $column;
            $this->sortAsc = false;
        }
    }

    protected function applySorting($query)
    {
        if (!$this->sortCol) {
            return $query->orderBy('created_at', 'desc');
        }

        if ($this->sortCol === 'nombres') {
            $query->orderBy('nombres', $this->sortAsc ? 'asc' : 'desc');
        }

        if ($this->sortCol === 'creado') {
            $query->orderBy('created_at', $this->sortAsc ? 'asc' : 'desc');
        }

        if ($this->sortCol === 'sexo') {
            $query->orderBy('sexo', $this->sortAsc ? 'asc' : 'desc');
        }

        if ($this->sortCol === 'perfil') {
            $perfiles = PersonalInstitucionalGWDATA::getPerfilInstitucional()
                ->pluck('name', 'id')
                ->toArray();

            if ($this->sortAsc) {
                asort($perfiles);
            } else {
                arsort($perfiles);
            }

            $ids = array_keys($perfiles);

            $query->orderByRaw('FIELD(perfil_institucional_id, ' . implode(',', $ids) . ')');
        }

        return $query;
    }
}
