<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {

        return view('livewire.dashboard', [
            'usuario' => auth()->user()->load('pais')
        ]);
    }
}
