<?php

namespace App\Livewire\Inscripcion\Create;

use Carbon\Carbon;
use App\Models\Pais;
use Livewire\Component;
use App\Models\Inscripcion;
use Livewire\Attributes\On;
use App\Models\TipoBeneficiarioGWDATA;
use App\Models\InstitucionOrganizacion;
use App\Livewire\Inscripcion\InscripcionDataTrait;
use App\Livewire\Inscripcion\Forms\InscripcionForm;

class Modal extends Component {

    use InscripcionDataTrait;

    public Pais $pais;

    public InscripcionForm $form;

    public $labels;

    public $data;

    public $institucionOrganizacion;

    public $openDrawer = false;

    public Inscripcion $inscripcion;

    public bool $showSuccessIndicator = false;

    public $isPnc;

    public function mount()
    {
        $this->data = $this->getData();

        $this->labels = $this->getLabels();

        $this->form->init($this->pais);
        $this->isPnc = false;
    }


    public function render()
    {
        return view('livewire.inscripcion.create.modal', $this->data);
    }

    public function updated($propertyName, $value)
    {

        switch ($propertyName)
        {
            case 'form.fecha_nacimiento':
                $current = Carbon::today($this->pais->timezone);
                $fechaNacimiento = Carbon::createFromDate($value);

                $current->subYears(18);

                if ($fechaNacimiento > $current) {
                    $this->form->fecha_nacimiento_validacion = false;
                    $this->addError('form.fecha_nacimiento', 'Solo se permiten personas para mayores de 18 años.');
                }
                else {
                    $this->form->fecha_nacimiento_validacion = true;
                }

                break;

            case 'form.pertenece_departamento_id':
                $this->form->perteneceCiudades = $this->setCiudad($value);
                break;

            case 'form.pertenece_ciudad_id':
                $this->form->perteneceSede = $this->getSedesEscuelas($value);
                break;

            case 'form.perfil_institucional_id':
                $this->form->initSelectedValues();
                $selected = $this->data['perfilInstitucionales']->get($value);
                $this->is_dgdp = false;

                if (str_contains($selected, 'Docentes de Educación')) {
                    $this->form->institucionalEducacionSelect = $this->getSubtipos($value);

                    // Remover Gestor/a pedagógico para todos los paises a excepción de El Salvador
                    $this->form->removerGestorpedagogicoPorPais();

                    $this->is_dgdp = true;
                }

                if (str_contains($selected, 'Personal de la Policía')) {
                    $this->form->institucionalPoliciaSelect = $this->getSanamenteSubtipos($value);

                    // Remover policia militar de la lista
                    $this->form->removerPoliciaMilitar();

                    if ($this->pais->nombre == 'El Salvador') {
                        $this->form->institucionalPoliciaSelect = $this->form->institucionalPoliciaSelect
                            ->filter(function ($item, $key) {
                                return in_array($key, [2]);
                            });
                    }
                }

                if (str_contains($selected, 'Personal de organizaciones')) {
                    $this->form->rangoOrganizacionesSelect = $this->getSanamenteSubtipos($value);
                }

                if (str_contains($selected, 'Personal de Salud')) {
                    $this->form->rangoSaludSelect = $this->getSanamenteSubtipos($value);
                }
                break;

            case 'form.perfil_institucional_policia_id':
                $selected = $this->form->institucionalPoliciaSelect->get($value);

                if (str_contains($selected, 'Personal de la Policía Nacional')) {
                    $this->form->rangosSelect = $this->getSubtipos($this->form->perfil_institucional_id);

                    // Remover valores repetidos
                    $this->form->removerPoliciaNacionalDuplicados();
                } else {
                    $this->form->rangosSelect = [];
                }
                break;

            case 'form.perfil_rango_salud_id':
                $selected = $this->form->rangoSaludSelect->get($value);

                if (str_contains($selected, 'Personal de Hospital') || str_contains($selected, 'Personal de Unidad')) {
                    $this->form->personalSaludSelect = $this->getSubtipos($this->form->perfil_institucional_id);

                    // Remover valores repetidos
                    $this->form->removerPersonalSaludDuplicados();
                } else {
                    $this->form->personalSaludSelect = [];
                }
                break;
        }
    }

    #[On('openModalInscripcion')]
    public function openModal(Inscripcion $inscripcion)
    {
        $this->showSuccessIndicator = false;

        $this->openDrawer = true;

        $this->inscripcion = $inscripcion;

        $this->form->customReset();

        $this->loadPersonalInstitucional();

        $this->form->init($this->pais);
        $this->form->setInscripcion($this->inscripcion);

        $this->form->fecha_nacimiento_validacion = true;

        if ($this->form->isPnc) {
            $this->isPnc = $this->form->isPnc;

            $dni = explode('/', $this->form->documento_identidad);
            $this->form->documento_identidad = $dni[count($dni) - 1];
        }

        $this->institucionOrganizacion = InstitucionOrganizacion::find($this->form->institucion_organizacion_id);

        if ($this->institucionOrganizacion) {
            $this->form->perteneceDepartamentos = $this->getDepartamentosPorSede(
                json_decode($this->institucionOrganizacion->sede_id)
            );

            $this->form->perteneceCiudades = $this->setCiudad(
                $this->form->pertenece_departamento_id,
                json_decode($this->institucionOrganizacion->sede_id)
            );

            $this->form->perteneceSede = $this->getSedesEscuelas(
                $this->form->pertenece_ciudad_id,
                json_decode($this->institucionOrganizacion->sede_id)
            );
        }
        else {
            $this->form->perteneceCiudades = $this->setCiudad($this->form->pertenece_departamento_id);
            $this->form->perteneceSede = $this->getSedesEscuelas($this->form->pertenece_ciudad_id);
        }

        $selected = $this->data['perfilInstitucionales']->get($this->form->perfil_institucional_id);

        if (str_contains($selected, 'Docentes de Educación')) {
            $this->form->institucionalEducacionSelect = $this->getSubtipos($this->form->perfil_institucional_id);

            // Remover Gestor/a pedagógico para todos los paises a excepción de El Salvador
            $this->form->removerGestorpedagogicoPorPais();
        }

        if (str_contains($selected, 'Personal de la Policía')) {
            $this->form->institucionalPoliciaSelect = $this->getSanamenteSubtipos($this->form->perfil_institucional_id);

            // Remover policia militar de la lista
            $this->form->removerPoliciaMilitar();
        }

        if (str_contains($selected, 'Personal de organizaciones')) {
            $this->form->rangoOrganizacionesSelect = $this->getSanamenteSubtipos($this->form->perfil_institucional_id);
        }

        if (str_contains($selected, 'Personal de Salud')) {
            $this->form->rangoSaludSelect = $this->getSanamenteSubtipos($this->form->perfil_institucional_id);
        }

        if ($this->form->perfil_institucional_policia_id && $this->form->institucionalPoliciaSelect) {
            $selected = $this->form->institucionalPoliciaSelect->get($this->form->perfil_institucional_policia_id);

            if (str_contains($selected, 'Personal de la Policía Nacional')) {
                $this->form->rangosSelect = $this->getSubtipos($this->form->perfil_institucional_id);

                // Remover valores repetidos
                $this->form->removerPoliciaNacionalDuplicados();
            } else {
                $this->form->rangosSelect = [];
            }
        }

        if ($this->form->perfil_rango_salud_id && $this->form->rangoSaludSelect) {
            $selected = $this->form->rangoSaludSelect->get($this->form->perfil_rango_salud_id);

            if (str_contains($selected, 'Personal de Hospital') || str_contains($selected, 'Personal de Unidad')) {
                $this->form->personalSaludSelect = $this->getSubtipos($this->form->perfil_institucional_id);

                // Remover valores repetidos
                $this->form->removerPersonalSaludDuplicados();
            } else {
                $this->form->personalSaludSelect = [];
            }
        }

        $this->dispatch('load-ciudades');
        $this->dispatch('load-sedes');
        $this->dispatch('load-perfil-institucional');
    }

    public function save()
    {

        $this->form->save();
        $this->form->init($this->pais);

        $this->showSuccessIndicator = true;

        $this->openDrawer = false;

        $this->dispatch('update-table-data');
    }

    public function loadPersonalInstitucional()
    {
        $this->form->pertenece_departamento_id = null;
        $this->form->pertenece_ciudad_id = null;
        $this->form->pertenece_sede_id = null;

        $this->form->perteneceDepartamentos = [];
        $this->form->perteneceCiudades = [];
        $this->form->perteneceSede = [];

        $this->form->hasPerfilIdentificas = true;

        $this->institucionOrganizacion = InstitucionOrganizacion::find($this->inscripcion->institucion_organizacion_id);

        if ($this->institucionOrganizacion) {
            $this->form->perteneceDepartamentos = $this->getDepartamentosPorSede(
                json_decode($this->institucionOrganizacion->sede_id)
            );
        }

        //MARIANO
        $this->resetData();

        $saludData = InstitucionOrganizacion::whereNotNull('active_at')->where('pais_id', $this->pais->id)->where("nombre", "Salud")->select("id")->first();

        $educacionData = InstitucionOrganizacion::whereNotNull('active_at')->where('pais_id', $this->pais->id)->where("nombre", "Educación")->select("id")->first();

        $organizacionData = InstitucionOrganizacion::whereNotNull('active_at')->where('pais_id', $this->pais->id)->where("nombre", "Organizaciones e instituciones")->select("id")->first();

        $seguridadData = InstitucionOrganizacion::whereNotNull('active_at')
            ->where('pais_id', $this->pais->id)
            ->where("nombre", "Seguridad pública")
            ->select("id")
            ->first();

        $comunidadData = InstitucionOrganizacion::whereNotNull('active_at')
            ->where('pais_id', $this->pais->id)
            ->where("nombre", "Miembro de la comunidad")
            ->select("id")
            ->first();


        if ($this->inscripcion->institucion_organizacion_id == $saludData->id) { //SALUD

            if (!$this->isOtherPerfilIdentifica()) {
                $this->form->perfil_identificas = 10; // Persona Institucional
            }

            $this->form->initSelectedValues();
            $this->form->perfil_institucional_id = 2; // Personal de salud
            $this->is_dgdp = false;

            $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                return in_array($key, [2]);
            });

            $this->form->rangoSaludSelect = $this->getSanamenteSubtipos($this->form->perfil_institucional_id);

        }elseif($this->inscripcion->institucion_organizacion_id == $educacionData->id){ // EDUCACION

            if (!$this->isOtherPerfilIdentifica()) {
                $this->form->perfil_identificas = 10; // Persona Institucional
            }

            $this->form->perfil_institucional_id = null;
            $this->form->initSelectedValues();

            $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                return in_array($key, [14, 15, 16]);
            });

        }elseif($this->inscripcion->institucion_organizacion_id == $organizacionData->id){

            if (!$this->isOtherPerfilIdentifica()) {
                $this->form->perfil_identificas = 10; // Persona Institucional
            }

            $this->form->perfil_institucional_id = null;
            $this->form->initSelectedValues();
            $this->is_dgdp = false;

            $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                return in_array($key, [6,3,5]);
            });

        }elseif($this->inscripcion->institucion_organizacion_id == $seguridadData->id){

            if (!$this->isOtherPerfilIdentifica()) {
                $this->form->perfil_identificas = 10; // Persona Institucional
            }

            $this->form->perfil_institucional_id = null;
            $this->form->initSelectedValues();
            $this->is_dgdp = false;

            $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                return in_array($key, [1,13]);
            });

            if ($this->pais->nombre == 'El Salvador') {
                $this->form->perfil_institucional_policia_id = 2;
            }

        }elseif($comunidadData && $this->inscripcion->institucion_organizacion_id == $comunidadData->id){

            $this->form->perfil_institucional_id = null;
            $this->form->initSelectedValues();
            $this->is_dgdp = false;
            $this->form->hasPerfilIdentificas = false;

            $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                return in_array($key, [0]);
            });

        }
        else {
            $this->form->perfil_institucional_id = null;
            $this->form->initSelectedValues();
            $this->is_dgdp = false;

            $this->form->institucion_organizacion_id = null;
        }


        if ($this->isOtherPerfilIdentifica()) {
            if ($this->institucionOrganizacion->nombre == 'Miembro de la comunidad') {
                $this->data['perfilIdentificas'] = TipoBeneficiarioGWDATA::whereIn('id', [2, 18])
                    ->pluck('name', 'id');
            }
            else {
                $this->data['perfilIdentificas'] = TipoBeneficiarioGWDATA::whereIn('id', [10])
                    ->pluck('name', 'id');

                $this->form->perfil_identificas = 10; // Persona Institucional
            }
        }
    }

    public function resetData()
    {
        $this->data['perfilInstitucionales'] = \App\Models\PersonalInstitucionalGWDATA::where('active_at', '<>', null)
            ->orderBy('name')
            ->pluck('name', 'id');

        // Solo muestra personal de la policia para el perfil de PNC
        if ($this->pais->nombre === 'El Salvador' && $this->form->isPnc) {
            $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                return str_contains($item, 'Personal de la Policía');
            });
        }
    }

    public function isDNIRequired()
    {
        // Remueve validacion para Colombia
        $ruleColombia = $this->pais->slug !== 'colombia';

        // Remueve validacion para "Miembro de la comunidad" de Mexico
        $ruleMexico = true;

        if (!empty($this->form->institucion_organizacion_id)) {
            $ruleMexico = $this->pais->slug === 'mexico'
                && $this->data['institucionOrganizaciones']->get($this->form->institucion_organizacion_id) !== 'Miembro de la comunidad';
        }

        // Enviar la validacion al Form para usarlo en rules()
        $this->form->isDNIRequired = $ruleColombia && $ruleMexico;

        return $this->form->isDNIRequired;
    }
}
