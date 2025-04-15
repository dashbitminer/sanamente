<?php

namespace App\Livewire\Admin\Permisos\Index;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Table extends Component
{
    public $showSuccessIndicator = false;

    public $canEdit = true;

    public function mount(){
        $this->canEdit = auth()->user()->can('Editar permisos');
    }

    #[On('refresh-permisos')]
    public function render()
    {
        return view('livewire.admin.permisos.index.table',
        [
            'roles' => \Spatie\Permission\Models\Role::all(),
            'permissionCategories' => \App\Models\Permission::all()
                ->groupBy('categoria')
                ->map(function ($permissions, $categoria) {
                    return [
                        $categoria,
                        $permissions->values()
                    ];
                })
                ->values(),
            ]);
    }

    public function delete(Permission $permission)
    {
        if(!auth()->user()->can('Eliminar permisos')) {
            abort(404);
        }

        $permission->delete();

        $this->dispatch('refresh-permisos');

        $this->showSuccessIndicator = true;
    }

    public function togglePermission($permission_id, $role_id)
    {
        if(!auth()->user()->can('Editar permisos')) {
            return;
        }

        $role = \Spatie\Permission\Models\Role::findById($role_id);
        $permission = Permission::findById($permission_id);

        if ($role->hasPermissionTo($permission->name)) {  
            $role->revokePermissionTo($permission->name);
        } else {
            $role->givePermissionTo([$permission->name]);
            $role->forgetCachedPermissions();
        }

        $this->dispatch('refresh-permisos');

        $this->showSuccessIndicator = true;
    }
}
