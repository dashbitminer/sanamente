<?php

namespace App\Livewire\FGSM\Index;

use App\Models\Pais;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Config;

class Page extends Component
{

    public Filters $filters;

    public Pais $pais;

    public function mount()
    {
        

        $user = auth()->user()->load('pais');

        // Set the application's timezone to the user's timezone
        if ($user->timezone) {
            Config::set('app.timezone', $user->timezone);
            date_default_timezone_set($user->timezone);
        }

        $this->pais = $user->pais;
    }


    #[Layout('layouts.app')]
    public function render()
    {
        if (!auth()->user()->can('Ver seguimientos FGSM')){
            abort(404);
        }
        
        return view('livewire.FGSM.index.page');
    }
}
