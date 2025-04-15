<?php

namespace App\Livewire\Inscripcion\Create;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Pais;
use App\Models\Inscripcion;
use App\Models\GradoGWDATA;
use App\Models\InstitucionOrganizacion;
use App\Models\TipoBeneficiarioGWDATA;
use App\Models\ParticipanteGWDATA;
use App\Livewire\Inscripcion\InscripcionDataTrait;
use App\Livewire\Inscripcion\Forms\InscripcionForm;
use Carbon\Carbon;

class Page extends Component
{
    use InscripcionDataTrait;

    public Pais $pais;

    public InscripcionForm $form;

    public bool $showSuccessIndicator = false;

    public $labels;

    public $data;

    public $institucionOrganizacion;

    public $is_dgdp = false;

    public function mount(?Inscripcion $inscripcion)
    {
        $this->form->init($this->pais);
        $this->form->setInscripcion($inscripcion);

        $this->labels = $this->getLabels();
        $this->data = $this->getData();
    }

    public function updated($propertyName, $value)
    {
        //dd($propertyName, $value);
        switch ($propertyName) {
            case 'form.fecha_nacimiento':

                $this->clearValidation('form.fecha_nacimiento');

                if (Carbon::hasFormat($value, 'Y-m-d')) {

                    $current = Carbon::today($this->pais->timezone);

                    $fechaNacimiento = Carbon::createFromFormat('Y-m-d', $value, $this->pais->timezone);
                    $fechaNacimiento->setHour(0)->setMinute(0)->setSecond(0);

                    if (!$fechaNacimiento->isValid()) {
                        $this->form->fecha_nacimiento_validacion = false;
                        $this->addError('form.fecha_nacimiento', 'Ingrese una fecha valida.');
                        return;
                    }

                    $current->subYears(18);

                    if ($fechaNacimiento > $current) {
                        $this->form->fecha_nacimiento_validacion = false;
                        $this->addError('form.fecha_nacimiento', 'Solo se permiten personas para mayores de 18 años.');
                    } else {
                        $this->form->fecha_nacimiento_validacion = true;
                    }
                }

                break;

            case 'form.nacionalidad':
                $this->form->documento_identidad = null;

                if ($value == Inscripcion::NACIONAL) {
                    $this->form->dni_placeholder = $this->form->setCountry($this->pais)->getPlaceholder();
                    $this->form->dni_mask = $this->form->setCountry($this->pais)->getMask();
                }

                if ($value == Inscripcion::EXTRANJERO) {
                    $this->form->dni_placeholder = '';
                    $this->form->dni_mask = '';
                }

                if ($this->form->isPnc) {
                    $this->form->dni_placeholder = '0000';
                    $this->form->dni_mask = '9999';
                }
                break;

            case 'form.departamento_id':
                $this->form->ciudad_id = null;
                $this->form->ciudades = $this->getAllCiudad($this->form->departamento_id);
                break;

            case 'form.institucion_organizacion_id':
                $this->form->pertenece_departamento_id = null;
                $this->form->pertenece_ciudad_id = null;
                $this->form->pertenece_sede_id = null;

                $this->form->perteneceDepartamentos = [];
                $this->form->perteneceCiudades = [];
                $this->form->perteneceSede = [];

                $this->form->hasPerfilIdentificas = true;

                $this->institucionOrganizacion = InstitucionOrganizacion::find($this->form->institucion_organizacion_id);

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


                if ($value == $saludData->id) { //SALUD

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

                }elseif($value == $educacionData->id){ // EDUCACION

                    if (!$this->isOtherPerfilIdentifica()) {
                        $this->form->perfil_identificas = 10; // Persona Institucional
                    }

                    $this->form->perfil_institucional_id = null;
                    $this->form->initSelectedValues();

                    $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                        return in_array($key, [14, 15, 16]);
                    });

                }elseif($value == $organizacionData->id){

                    if (!$this->isOtherPerfilIdentifica()) {
                        $this->form->perfil_identificas = 10; // Persona Institucional
                    }

                    $this->form->perfil_institucional_id = null;
                    $this->form->initSelectedValues();
                    $this->is_dgdp = false;

                    $this->data['perfilInstitucionales'] = $this->data['perfilInstitucionales']->filter(function ($item, $key) {
                        return in_array($key, [6,3,5]);
                    });

                }elseif($value == $seguridadData->id){

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

                }elseif($comunidadData && $value == $comunidadData->id){

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

                break;

            case 'form.pertenece_departamento_id':
                $this->form->pertenece_ciudad_id = null;
                $this->form->pertenece_sede_id = null;

                $this->form->perteneceCiudades = $this->setCiudad(
                    $this->form->pertenece_departamento_id,
                    json_decode($this->institucionOrganizacion->sede_id)
                );
                break;

            case 'form.pertenece_ciudad_id':
                $this->form->pertenece_sede_id = null;

                $this->form->perteneceSede = $this->getSedesEscuelas(
                    $this->form->pertenece_ciudad_id,
                    json_decode($this->institucionOrganizacion->sede_id)
                );
                break;

            case 'form.labora_departamento_id':
                $this->form->laboraCiudades = $this->getAllCiudad($value);
                break;

            case 'form.perfil_identificas':
                if (empty($value)) {
                    $this->form->perfil_identificas = null;
                    $this->form->initSelectedValues();
                }
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

            case 'form.documento_identidad':
                $this->clearValidation('form.documento_identidad');

                $this->hasDNI();
                break;

            case 'form.grado_id':
                $grado = $this->data['grados']->get($value);

                $this->form->gradoSuperior = match ($grado) {
                    GradoGWDATA::TECNICO, GradoGWDATA::UNIVERSITARIOS, GradoGWDATA::MASTER => true,
                    default => false,
                };

                if ($this->form->gradoSuperior) {
                    $this->form->grado_seccion_id = null;
                    $this->form->grado_jornada_id = null;
                }
                break;
        }

        $this->form->is_dgdp = $this->is_dgdp;
    }

    #[Layout('layouts.inscripcion')]
    public function render()
    {
        return view('livewire.inscripcion.create.page', $this->data);
    }

    public function save()
    {
        if ($this->form->datosDuplicados) {
            $this->form->showErrorIndicator = true;
            return;
        }

        $this->form->save();
        $this->showSuccessIndicator = true;

        $this->form->init($this->pais);
    }

    public function hasDNI()
    {
        if (!empty($this->form->documento_identidad)) {
            $inscripcion = Inscripcion::active()
                ->whereLike('documento_identidad', $this->form->documento_identidad . '%')
                ->first();

            // Verifica que los datos aun no se han importado
            if ($inscripcion) {
                $this->form->datosDuplicados = true;
                $this->form->showErrorIndicator = true;

                $this->addError('form.documento_identidad', 'Los datos ya fueron guardados');

                return;
            } else {
                // Verifica si el DNI existe en la base de GWDATA
                $benefiriario = ParticipanteGWDATA::select('id')
                    ->whereLike('DNI', $this->form->documento_identidad . '%')
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
    }

    #[On('load-inscripcion')]
    public function loadInscripcion()
    {
        if (!empty($this->form->documento_identidad) && $this->form->nacionalidad == 1) {
            $inscripcion = Inscripcion::active()
                ->whereLike('documento_identidad', $this->form->documento_identidad . '%')
                ->first();

            // Verifica que los datos aun no se han importado
            // if ($inscripcion) {
            //     if ($inscripcion->imported_at) {
            //         $this->form->datosDuplicados = true;
            //         $this->form->showErrorIndicator = true;

            //         $this->clearValidation('form.documento_identidad');
            //         $this->addError('form.documento_identidad', 'Los datos ya fueron importados');

            //         return;
            //     }
            // }
            // else {
            //     // Verifica si el DNI existe en la base de GWDATA
            //     $benefiriario = ParticipanteGWDATA::select('id')
            //         ->whereLike('DNI', $this->form->documento_identidad . '%')
            //         ->where('fkCodeCountry', $this->pais->codigo)
            //         ->first();

            //     if ($benefiriario) {
            //         $this->form->datosDuplicados = true;
            //         $this->form->showErrorIndicator = true;

            //         $this->clearValidation('form.documento_identidad');
            //         $this->addError('form.documento_identidad', 'Datos ya existen en GWDATA');

            //         return;
            //     }
            // }

            $this->form->datosDuplicados = false;

            if ($inscripcion) {
                $this->form->setInscripcion($inscripcion);

                $this->form->ciudades = $this->setCiudad($this->form->departamento_id);
                $this->form->perteneceCiudades = $this->setCiudad($this->form->pertenece_departamento_id);
                $this->form->laboraCiudades = $this->setCiudad($this->form->labora_departamento_id);

                $this->form->perteneceSede = $this->getSedesEscuelas($this->form->pertenece_ciudad_id);

                $selected = $this->data['perfilInstitucionales']->get($this->form->perfil_institucional_id);

                $grado = $this->data['grados']->get($inscripcion->grado_id);

                $this->form->gradoSuperior = match ($grado) {
                    GradoGWDATA::TECNICO, GradoGWDATA::UNIVERSITARIOS, GradoGWDATA::MASTER => true,
                    default => false,
                };

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

    public function reloadPage() {
        return redirect()->route('inscripcion.create', [
            'pais' => $this->pais->slug,
        ]);
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
