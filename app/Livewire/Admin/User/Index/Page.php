<?php

namespace App\Livewire\Admin\User\Index;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Admin\User\Index\Filters;

class Page extends Component
{
    public Filters $filters;

    #[Layout('layouts.app')]
    public function render()
    {
        if (!auth()->user()->can('Ver usuarios')) {
            abort(404);
        }
        return view('livewire.admin.user.index.page');
    }

    public function updated($property, $value){
        if(str_starts_with($property, 'filters.paisSelected')){
            $this->dispatch('manual-reset-page');
        }
    }
}
