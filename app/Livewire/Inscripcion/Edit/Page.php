<?php

namespace App\Livewire\Inscripcion\Edit;

use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use App\Livewire\Inscripcion\Create\Page as Create;
use App\Models\Inscripcion;
use App\Models\InstitucionOrganizacion;
use App\Models\TipoBeneficiarioGWDATA;

class Page extends Create
{
    public function mount(?Inscripcion $inscripcion)
    {
        if (!auth()->user()->can('Editar inscripción formaciones SM')){
            abort(404);
        }

        $this->labels = $this->getLabels();
        $this->data = $this->getData();

        // Filtra "persona institucional" por tipo de organizacion
        $this->form->institucion_organizacion_id = $inscripcion->institucion_organizacion_id;
        $this->updated('form.institucion_organizacion_id', '');

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

            if ($this->institucionOrganizacion->nombre == 'Miembro de la comunidad') {
                $this->form->hasPerfilIdentificas = false;

                $this->data['perfilIdentificas'] = TipoBeneficiarioGWDATA::whereIn('id', [2, 18])
                    ->pluck('name', 'id');
            }
        }

        if ($this->form->isPnc) {
            $this->isPnc = $this->form->isPnc;

            $dni = explode('/', $this->form->documento_identidad);
            $this->form->documento_identidad = $dni[count($dni) - 1];
        }

        if ($this->form->ciudades instanceof Collection && $this->form->ciudades->count() == 0) {
            $this->form->ciudades = $this->getAllCiudad($this->form->departamento_id);
        }
    }

    public function save()
    {
        $this->form->save();

        sleep(1);

        return redirect()->route('inscripcion.edit', [
            'pais' => $this->pais->slug,
            'inscripcion' => $this->form->inscripcion->id,
        ]);
    }
}
