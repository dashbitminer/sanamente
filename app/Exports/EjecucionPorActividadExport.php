<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class EjecucionPorActividadExport  implements FromView
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('livewire.FGSM.exports.ejecucion-por-actividad', [
            'actividades' => $this->data
        ]);
    }
}
