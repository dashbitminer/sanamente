<?php
namespace App\Livewire\Admin\Roles\Edit;

use App\Livewire\Admin\Roles\Forms\RoleForms;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Pais;
use App\Models\Role;

class Page extends Component
{
    public RoleForms $form;

    public $openDrawer = false;

    public $showSuccessIndicator = false;

    public $categorias = [];

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.admin.roles.edit.page');
    }

    #[On('openEdit')]
    public function openEdit($id){
        if (!auth()->user()->can('Editar roles')) {
            abort(404);
        }

        $this->form->isEdit = true;
        $this->form->setRole($id);
        $this->openDrawer = true;
    }

    public function save()
    {
        if (!auth()->user()->can('Editar roles')) {
            abort(404);
        }
        
        $this->form->save();
        $this->showSuccessIndicator = true;
        $this->openDrawer = false;

        $this->form->unsetRole();
        $this->form->clearFields();

        $this->dispatch('refresh-roles');
    }
}