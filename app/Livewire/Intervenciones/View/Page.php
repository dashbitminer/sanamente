<?php

namespace App\Livewire\Intervenciones\View;

use Livewire\Component;
use App\Livewire\Intervenciones\Create\Page AS RegistroDeIntervencionesDirectas;
use App\Models\Intervencion;

class Page extends RegistroDeIntervencionesDirectas
{
    public function mount(?Intervencion $intervencion)
    {
        $this->form->init($this->pais);
        $this->form->loadByTipoIntervencion($intervencion);
        $this->form->mode = 'view';

        $this->setCiudad($this->form->departamento_id);
        $this->setSede($this->form->ciudad_id);

        $this->data = $this->getData();
    }
}
