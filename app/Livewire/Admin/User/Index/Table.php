<?php

namespace App\Livewire\Admin\User\Index;

use App\Exports\UserExport;
use App\Models\Pais;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Reactive;
use Spatie\Permission\Models\Role;
use App\Livewire\Admin\User\Index\Sortable;
use App\Livewire\Admin\User\Index\Searchable;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;

class Table extends Component
{

    use WithPagination, Searchable, Sortable;

    public $selectedRecordIds = [];

    public $recordsIdsOnPage = [];

    public $selectedFormulario;

    public $perPage = 10;

    public $showSuccessIndicator;


    public Filters $filters;

    #[Renderless]
    public function export()
    {
        return (new UserExport($this->selectedRecordIds, $this->filters, $this->search))
                ->download('users.xlsx');

    }

    #[On('refresh-usuarios')]
    public function render()
    {

        $query = User::with('roles', 'pais');

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $query = $this->filters->apply($query);

        $users = $query->paginate($this->perPage);

        $this->recordsIdsOnPage = $users->map(fn($user) => (string) $user->id)->toArray();

        return view('livewire.admin.user.index.table', [
            'users' => $users,
            'paises' => Pais::pluck("nombre", "id"),
            'roles' => Role::pluck("name", "id")
        ]);
    }

    public function deleteSelected()
    {
        if (!auth()->user()->can('Eliminar usuarios')) {
            abort(404);
        }

        User::whereIn('id', $this->selectedRecordIds)->delete();

        $this->dispatch('refresh-usuarios');
    }
    
    public function delete(User $user)
    {
        if (!auth()->user()->can('Eliminar usuarios')) {
            abort(404);
        }
        
        $user->delete();

        $this->dispatch('refresh-usuarios');

        $this->showSuccessIndicator = true;
    }

    #[On('manual-reset-page')]
    public function manualResetPage()
    {
        $this->resetPage();
    }

    
}
