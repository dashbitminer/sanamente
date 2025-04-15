<?php
namespace App\Livewire\Admin\Permisos\Create;

use App\Livewire\Admin\Permisos\Forms\PermisoForms;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
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
        return view('livewire.admin.permisos.create.page');
    }

    #[On('openCreate')]
    public function openCreate(){
        if(!auth()->user()->can('Crear permisos')) {
            abort(404);
        }

        $this->openDrawer = true;

        $this->categorias = \App\Models\Permission::all()
            ->groupBy('categoria')
            ->keys()
            ->toArray();
    }

    public function save()
    {
        if(!auth()->user()->can('Crear permisos')) {
            abort(404);
        }
        
        $this->form->save();
        $this->showSuccessIndicator = true;
        $this->openDrawer = false;
        $this->form->clearFields();
        $this->dispatch('refresh-permisos');
    }
}