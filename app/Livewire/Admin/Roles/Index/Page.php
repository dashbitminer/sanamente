<?php

namespace App\Livewire\Admin\Roles\Index;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Page extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        if (!auth()->user()->can('Ver roles')) {
            abort(404);
        }
        
        return view('livewire.admin.roles.index.page');
    }
}
