<?php

namespace App\Livewire\Intervenciones\Index;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Config;
use App\Models\Pais;

class Page extends Component
{
    public Pais $pais;

    public Filters $filters;

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
        if(!auth()->user()->can('Ver intervenciones directas SM')){
            abort(404);
        }

        return view('livewire.intervenciones.index.page');
    }
}
