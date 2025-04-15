<?php

namespace App\Livewire\Inscripcion\Edit;

use Livewire\Component;
use App\Livewire\Inscripcion\Create\Policia as PoliciaCreate;
use App\Models\Inscripcion;
use App\Models\InstitucionOrganizacion;
use Carbon\Carbon;

class Policia extends PoliciaCreate
{
    public function mount(?Inscripcion $inscripcion)
    {
        $this->labels = $this->getLabels();
        $this->data = $this->getData();

        $this->form->init($this->pais);
        $this->form->setInscripcion($inscripcion);
        $this->form->mode = 'edit';

        $this->loadInscripcion();

        $this->form->fecha_nacimiento_validacion = true;

        $this->institucionOrganizacion = InstitucionOrganizacion::find($this->form->institucion_organizacion_id);

        if ($this->institucionOrganizacion) {
            $this->form->perteneceDepartamentos = $this->getDepartamentosPorSede(
                json_decode($this->institucionOrganizacion->sede_id)
            );
        }

        $this->isPnc = $this->form->isPnc;

        $dni = explode('/', $this->form->documento_identidad);
        $this->form->documento_identidad = $dni[count($dni) - 1];

        $this->form->edad = Carbon::parse($this->form->fecha_nacimiento)->age;
    }

    public function save()
    {
        $this->form->save();

        sleep(1);

        return redirect()->route('inscripcion.edit.policia', [
            'pais' => $this->pais->slug,
            'inscripcion' => $this->form->inscripcion->id,
        ]);
    }
}
