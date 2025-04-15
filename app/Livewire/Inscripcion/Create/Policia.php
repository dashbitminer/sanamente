<?php

namespace App\Livewire\Inscripcion\Create;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Pais;
use App\Models\Inscripcion;
use App\Models\ParticipanteGWDATA;
use App\Models\InstitucionOrganizacion;
use App\Livewire\Inscripcion\InscripcionDataTrait;
use App\Livewire\Inscripcion\Forms\InscripcionForm;
use Carbon\Carbon;

class Policia extends Page
{
    use InscripcionDataTrait;

    public Pais $pais;

    public InscripcionForm $form;

    public bool $showSuccessIndicator = false;

    public $labels;

    public $data;

    public $institucionOrganizacion;

    public function mount(?Inscripcion $inscripcion)
    {
        $this->init($inscripcion);
    }

    public function init(?Inscripcion $inscripcion)
    {
        // Mantener el codigo de confirmacion despues de reestablecer todos los valores
        $codigo_confirmacion = $this->form->codigo_confirmacion;

        $this->form->init($this->pais);
        $this->form->setInscripcion($inscripcion);

        if ($this->pais->nombre == 'El Salvador') {
            $this->form->isPnc = true;
        }

        $this->form->codigo_confirmacion = $codigo_confirmacion;

        $this->labels = $this->getLabels();
        $this->data = $this->getData();

        // Para PNC los perfiles y discapacidad estan en NO
        $this->form->perfil_identificas = $this->data["perfilIdentificas"]->keys()->first();
        $this->form->perfil_institucional_id = $this->data["perfilInstitucionales"]->keys()->first();
        $this->form->discapacidad = 2;
        $this->form->derechos_image_voz = 2;    // Para GWDATA por defecto sera NO (2)
        $this->form->perfil_institucional_policia_id = null;

        $this->form->institucionalPoliciaSelect = $this->getSanamenteSubtipos($this->form->perfil_institucional_id);
        // Remover valores repetidos
        $this->form->removerPoliciaMilitar();
        // Remover Personal de la Policia Municipal
        if ($this->form->institucionalPoliciaSelect->has(2)) {
            $this->form->institucionalPoliciaSelect->forget(2);
        }


        $this->form->institucion_organizacion_id = 6;
        $this->institucionOrganizacion = InstitucionOrganizacion::find($this->form->institucion_organizacion_id);

        if ($this->institucionOrganizacion) {
            $this->form->perteneceDepartamentos = $this->getDepartamentosPorSede(
                json_decode($this->institucionOrganizacion->sede_id)
            );
        }
    }

    #[Layout('layouts.inscripcion')]
    public function render()
    {
        return view('livewire.inscripcion.create.policia', $this->data);
    }

    public function hasDNI()
    {
        $this->clearValidation('form.documento_identidad');

        $documento_identidad = $this->form->buildDocumentoIdentidadParaPnc();

        $inscripcion = Inscripcion::active()
            ->whereLike('documento_identidad', $documento_identidad)
            ->first();

        // Verifica que los datos aun no se han importado
        if ($inscripcion) {
            $this->form->datosDuplicados = true;
            $this->form->showErrorIndicator = true;

            if ($inscripcion->imported_at) {
                $this->addError('form.documento_identidad', 'Los datos ya fueron importados');
            }
            else {
                $this->addError('form.documento_identidad', 'Los datos ya fueron ingresados');
            }

            return;
        }
        else {
            // Verifica si el DNI existe en la base de GWDATA
            $benefiriario = ParticipanteGWDATA::select('id')
                ->whereLike('DNI', $documento_identidad)
                ->where('fkCodeCountry', $this->pais->codigo)
                ->first();

            if ($benefiriario) {
                $this->form->datosDuplicados = true;
                $this->form->showErrorIndicator = true;

                $this->addError('form.documento_identidad', 'Datos ya existen en GWDATA');

                return;
            }
        }

        $this->form->datosDuplicados = false;
    }

    public function updated($propertyName, $value)
    {
        if ($propertyName == 'form.edad') {
            $this->clearValidation('form.edad');

            if ((int) $value < 0) {
                $this->form->fecha_nacimiento_validacion = false;

                $this->addError('form.edad', 'Edad ingresada no valida.');
                return;
            }

            if ((int) $value < 18) {
                $this->form->fecha_nacimiento_validacion = false;

                $this->addError('form.edad', 'Menores de edad no pueden llenar este formulario.');
                return;
            }

            $current = Carbon::today($this->pais->timezone);
            $edad = $current->subYears($value)
                ->setDay(1)
                ->setMonth(1);

            $this->form->fecha_nacimiento = $edad->format('Y-m-d');
            $this->form->fecha_nacimiento_validacion = true;

            $this->form->perfil_institucional_policia_id = 2;
        }

        if ($propertyName == 'form.pertenece_sede_id') {
            $this->hasDNI();
        }

        parent::updated($propertyName, $value);

        // Remover Policía Militar y Personal de la Policía Municipal
        if ($propertyName == 'form.perfil_institucional_policia_id') {

            if ($this->form->rangosSelect && $this->form->rangosSelect->has([63, 64])) {
                $this->form->rangosSelect->forget([63, 64]);
            }

        }
    }

    public function save()
    {
        if ($this->form->datosDuplicados) {
            $this->form->showErrorIndicator = true;
            return;
        }

        $this->form->save();
        $this->showSuccessIndicator = true;

        $inscripcion = new Inscripcion();
        $this->init($inscripcion);
    }

    public function reloadPage() {
        return redirect()->route('inscripcion.create.policia', [
            'pais' => $this->pais->slug,
        ]);
    }
}
