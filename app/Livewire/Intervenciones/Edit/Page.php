<?php

namespace App\Livewire\Intervenciones\Edit;

use Livewire\Component;
use App\Livewire\Intervenciones\Create\Page AS RegistroDeIntervencionesDirectas;
use App\Models\Intervencion;

class Page extends RegistroDeIntervencionesDirectas
{
    public function mount(?Intervencion $intervencion)
    {
        $this->form->init($this->pais);
        $this->form->loadByTipoIntervencion($intervencion);
        $this->form->mode = 'edit';

        $this->setCiudad($this->form->departamento_id);
        $this->setSede($this->form->ciudad_id);

        $this->data = $this->getData();
    }

    public function save()
    {
        $this->form->save();

        sleep(1);

        return redirect()->route('intervenciones.edit', [
            'pais' => $this->pais->slug,
            'intervencion' => $this->form->intervencion->id,
        ]);
    }
}
