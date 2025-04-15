<?php

namespace App\Livewire\Admin\Permisos\Index;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Page extends Component
{    

    #[Layout('layouts.app')]
    public function render()
    {
        if (!auth()->user()->can('Ver permisos')){
            abort(404);
        }
        
        return view('livewire.admin.permisos.index.page');
    }
}
