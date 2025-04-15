<?php

namespace App\Livewire\FRP\Index;

use App\Models\Pais;
use Illuminate\Support\Facades\Config;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Page extends Component
{
    public Filters $filters;
    
    public Pais $pais;

    public $edad;

    public $esMenorEdad;

    public function mount()
    {
        $user = auth()->user()->load('pais');
        if ($user->timezone) {
            Config::set('app.timezone', $user->timezone);
            date_default_timezone_set($user->timezone);
        }
        
        $this->pais = $user->pais;

        $this->esMenorEdad = $this->menorDeEdad();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        if(!auth()->user()->can('Ver referencias RSAC')){
            abort(404);
        }
        return view('livewire.FRP.index.page');
    }

    public function menorDeEdad(){
        return $this->edad == 'menor';
    }
}