<?php

namespace App\Livewire\Admin\Permisos\Edit;

use App\Livewire\Admin\Permisos\Forms\PermisoForms;
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Livewire\Admin\User\Forms\UserForms;
use App\Models\Pais;
use App\Models\Role;

class Page extends Component
{
    public PermisoForms $form;

    public $openDrawer = false;

    public $showSuccessIndicator = false;

    public $categorias = [];

    public function mount(){
        $this->categorias = \App\Models\Permission::all()
            ->groupBy('categoria')
            ->keys()
            ->toArray();
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.permisos.edit.page');
    }

    #[On('openEdit')]
    public function openEdit($id){
    
        if(!auth()->user()->can('Editar permisos')) {
            abort(404);
        }
        $this->form->isEdit = true;
        
        $this->categorias = \App\Models\Permission::all()
            ->groupBy('categoria')
            ->keys()
            ->toArray();

        $this->form->setPermission($id);
        $this->openDrawer = true;
    }

    public function save()
    {
        if(!auth()->user()->can('Editar permisos')) {
            abort(404);
        }
        
        $this->form->save();
        $this->showSuccessIndicator = true;
        $this->openDrawer = false;
        

        $this->form->unsetPermission();
        $this->form->clearFields();

        $this->dispatch('refresh-permisos');
        
    }
}