<?php

namespace App\Livewire\Admin\User\Edit;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Livewire\Admin\User\Forms\UserForms;
use App\Models\Pais;
use App\Models\Role;

class Page extends Component
{
    public UserForms $form;

    public $openDrawer = false;

    public $showSuccessIndicator = false;

    public $roles = [];

    public $paises = [];

    public function mount(){
        $this->roles = $this->getRoles();
        $this->paises = Pais::pluck('nombre', 'id')->toArray();
    }

    public function getRoles()
    {
        $query = Role::orderBy('id', 'asc');

        if (!auth()->user()->hasRole('Super_Admin')) {
            $query->where('name', '!=', 'Super_Admin');
        }

        return $query->pluck('name', 'id')->toArray();
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.user.edit.page');
    }

    #[On('openEdit')]
    public function openEdit($id){

        if (!auth()->user()->can('Editar usuarios')) {
            abort(404);
        }

        $this->form->isEdit = true;
        $this->form->setUser($id);

        $this->openDrawer = true;
    }

    public function save()
    {
        if (!auth()->user()->can('Editar usuarios')) {
            abort(404);
        }
        
        $this->form->save();
        $this->showSuccessIndicator = true;
        $this->openDrawer = false;
        

        $this->form->unsetUser();
        $this->form->clearFields();

        $this->dispatch('refresh-usuarios');
        
    }
}