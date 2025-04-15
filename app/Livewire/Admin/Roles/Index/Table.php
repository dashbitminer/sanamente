<?php

namespace App\Livewire\Admin\Roles\Index;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;
use Livewire\Attributes\On;

class Table extends Component
{
    use WithPagination, Searchable, Sortable;

    public $perPage = 10;

    public $selectedRecordIds = [];

    public $recordsIdsOnPage = [];

    public $showSuccessIndicator = false;

    #[On('refresh-roles')]
    public function render(){

        $query = Role::query();
        
        if (!auth()->user()->hasRole('Super_Admin')) {
            $query->where('name', '!=', 'Super_Admin');
        }

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $roles = $query->paginate($this->perPage);

        $this->recordsIdsOnPage = $roles->map(fn($role) => (string) $role->id)->toArray();

        return view('livewire.admin.roles.index.table', [
            'roles' => $roles
        ]);
    }

    
    public function delete(Role $role)
    {
        if (!auth()->user()->can('Eliminar roles')){
            abort(404);
        }

        $role->delete();

        $this->dispatch('refresh-roles');

        $this->showSuccessIndicator = true;
    }
}
