<?php

namespace App\Livewire\Inscripcion\Forms;

use App\Models\Inscripcion;
use Livewire\Form;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use App\Dni;
use App\Models\Pais;
use App\PhoneLength;
use App\Models\EscuelaGWDATA;
use App\Facades\TicketCode;
use App\Rules\DocumentoIdentidadRule;
use Carbon\Carbon;

class InscripcionForm extends Form
{
    use Dni;

    public Pais $pais;

    public Inscripcion $inscripcion;

    public $showValidationErrorIndicator = false;

    public $showErrorIndicator = false;

    public $datosDuplicados = false;

    public $dni_mask;

    public $dni_placeholder;

    // Restringir digitos de numero telefonico por pais
    public $telephone_length;

    public $telephone_mask;

    public $fecha_nacimiento_max;

    public $fecha_nacimiento_validacion;

    public $ciudades;

    public $sedes;

    public $institucionalEducacionSelect;

    public $institucionalPoliciaSelect;

    public $rangosSelect;

    public $rangoOrganizacionesSelect;

    public $rangoSaludSelect;

    public $personalSaludSelect;

    public $perteneceDepartamentos;

    public $perteneceCiudades;

    public $perteneceSede;

    public $laboraCiudades;

    public $discapacidadesSelect;

    public $gradoSuperior;

    public $fullName;

    public $mode = 'create';

    public $isPnc;

    public $edad;

    public $hasPerfilIdentificas = true;

    public $isDNIRequired = true;


    #[Validate]
    public $fecha_nacimiento;

    #[Validate]
    public $institucion_organizacion_id;

    #[Validate]
    public $nombres;

    #[Validate]
    public $apellidos;

    #[Validate]
    public $sexo;

    public $pais_id;

    #[Validate]
    public $departamento_id;

    #[Validate]
    public $ciudad_id;

    #[Validate]
    public $nacionalidad;

    // #[Validate]
    public $documento_identidad;

    public $telefono;

    public $email;

    #[Validate]
    public $estudiando;

    #[Validate]
    public $grado_id;

    #[Validate]
    public $grado_seccion_id;

    #[Validate]
    public $grado_jornada_id;

    #[Validate]
    public $grado_alcanzado_id;

    #[Validate]
    public $discapacidad;

    #[Validate]
    public $inscripcion_discapacidad_id;

    #[Validate]
    public $ha_participado_actividades_glasswing;

    public $institutional_person_id_gwdata;

    public $beneficiaries_subtype_id_gwdata;

    #[Validate]
    public $perfil_identificas;

    #[Validate]
    public $perfil_institucional_id;

    #[Validate]
    public $perfil_institucional_educacion_id;

    #[Validate]
    public $perfil_institucional_policia_id;

    #[Validate]
    public $perfil_rango_id;

    #[Validate]
    public $perfil_rango_organizacion_id;

    #[Validate]
    public $perfil_rango_salud_id;

    #[Validate]
    public $perfil_personal_salud_id;

    #[Validate]
    public $pertenece_departamento_id;

    #[Validate]
    public $pertenece_ciudad_id;

    #[Validate]
    public $pertenece_sede_id;

    #[Validate]
    public $centro_educativo;

    #[Validate]
    public $centro_educativo_tipo_id;

    #[Validate]
    public $centro_educativo_cargo_id;

    #[Validate]
    public $labora_departamento_id;

    #[Validate]
    public $labora_municipio_id;

    #[Validate]
    public $labora_aldea_id;

    #[Validate]
    public $labora_caserio_id;

    #[Validate]
    public $labora_codigo_sace;

    #[Validate]
    public $centro_educativo_jornada;

    #[Validate]
    public $centro_educativo_nivel_id;

    #[Validate]
    public $centro_educativo_ciclo_id;

    #[Validate]
    public $centro_educativo_zona_geografica;

    public $autorizacion_informacion;

    public $derechos_image_voz;

    public $consentimiento;

    public $codigo_confirmacion;

    public $comentario;

    public $user_id;

    public $municipiosReside;

    public $escuelas;

    public $is_dgdp;


    public function boot()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                // dd($validator->errors());
                $this->showValidationErrorIndicator = true;
            }
        });
    }

    public function rules()
    {
        return [
            'fecha_nacimiento' => 'required|date',
            'institucion_organizacion_id' => 'required',
            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            'sexo' => 'required',
            'departamento_id' => 'required',
            'ciudad_id' => Rule::when($this->isPnc == false, ['required']),
            'nacionalidad' => 'required',
            'documento_identidad' => Rule::when($this->isDNIRequired, ['required']),
            'estudiando' => 'required',
            'grado_id' => 'required_if:estudiando,1',
            'grado_seccion_id' => Rule::when(
                $this->estudiando == 1
                && $this->gradoSuperior == false
                && $this->isPnc == false
                && $this->pais->slug !== 'colombia',
                ['required']
            ),
            'grado_jornada_id' => Rule::when(
                $this->estudiando == 1
                && $this->gradoSuperior == false
                && $this->isPnc == false
                && $this->pais->slug !== 'colombia',
                ['required']
            ),
            'grado_alcanzado_id' => 'required_if:estudiando,2',
            'discapacidad' => 'required',
            'discapacidadesSelect' => 'required_if:discapacidad,1',
            'ha_participado_actividades_glasswing' => 'required',
            'perfil_identificas' => 'required',
            'perfil_institucional_id' => 'required_if:hasPerfilIdentificas,true',
            'perfil_institucional_educacion_id' => 'required_if:perfil_institucional_id,14,15',
            'perfil_institucional_policia_id' => 'required_if:perfil_institucional_id,1',
            'perfil_rango_id' => 'required_if:perfil_institucional_policia_id,1',
            'perfil_rango_organizacion_id' => 'required_if:perfil_institucional_id,3',
            'perfil_rango_salud_id' => 'required_if:perfil_institucional_id,2',
            'perfil_personal_salud_id' => 'required_if:perfil_rango_salud_id,6,10',
            'pertenece_departamento_id' => 'required',
            'pertenece_ciudad_id' => 'required',
            'pertenece_sede_id' => 'required',
            'centro_educativo' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'centro_educativo_tipo_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'centro_educativo_cargo_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'labora_departamento_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'labora_municipio_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'labora_aldea_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'labora_caserio_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'labora_codigo_sace' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'centro_educativo_jornada' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'centro_educativo_nivel_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'centro_educativo_ciclo_id' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'centro_educativo_zona_geografica' => Rule::when($this->pais->slug == 'honduras' && $this->is_dgdp, ['required']),
            'autorizacion_informacion' => 'required',
            'consentimiento' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fecha_nacimiento.required' => 'El campo es requerido.',
            'institucion_organizacion_id.required' => 'El campo es requerido.',
            'nombres.required' => 'El campo es requerido.',
            'nombres.min' => 'El campo debe de ser de al menos 5 caracteres.',
            'apellidos.required' => 'El campo es requerido.',
            'apellidos.min' => 'El campo debe de ser de al menos 5 caracteres.',
            'sexo.required' => 'El campo es requerido.',
            'departamento_id.required' => 'El campo es requerido.',
            'ciudad_id.required' => 'El campo es requerido.',
            'nacionalidad.required' => 'El campo es requerido.',
            'documento_identidad.required' => 'El campo es requerido.',
            'estudiando.required' => 'El campo es requerido.',
            'grado_id.required_if' => 'El campo es requerido.',
            'grado_seccion_id.required' => 'El campo es requerido.',
            'grado_jornada_id.required' => 'El campo es requerido.',
            'grado_alcanzado_id.required_if' => 'El campo es requerido.',
            'discapacidad.required' => 'El campo es requerido.',
            'discapacidadesSelect.required_if' => 'El campo es requerido.',
            'ha_participado_actividades_glasswing.required' => 'El campo es requerido.',
            'perfil_identificas.required' => 'El campo es requerido.',
            'perfil_institucional_id.required_if' => 'El campo es requerido.',
            'perfil_institucional_educacion_id.required_if' => 'El campo es requerido.',
            'perfil_institucional_policia_id.required_if' => 'El campo es requerido.',
            'perfil_rango_id.required_if' => 'El campo es requerido.',
            'perfil_rango_organizacion_id.required_if' => 'El campo es requerido.',
            'perfil_rango_salud_id.required_if' => 'El campo es requerido.',
            'perfil_personal_salud_id.required_if' => 'El campo es requerido.',
            'pertenece_departamento_id.required' => 'El campo es requerido.',
            'pertenece_ciudad_id.required' => 'El campo es requerido.',
            'pertenece_sede_id.required' => 'El campo es requerido.',
            'centro_educativo.required' => 'El campo es requerido.',
            'centro_educativo_tipo_id.required' => 'El campo es requerido.',
            'centro_educativo_cargo_id.required' => 'El campo es requerido.',
            'labora_departamento_id.required' => 'El campo es requerido.',
            'labora_municipio_id.required' => 'El campo es requerido.',
            'labora_aldea_id.required' => 'El campo es requerido.',
            'labora_caserio_id.required' => 'El campo es requerido.',
            'labora_codigo_sace.required' => 'El campo es requerido.',
            'centro_educativo_jornada.required' => 'El campo es requerido.',
            'centro_educativo_nivel_id.required' => 'El campo es requerido.',
            'centro_educativo_ciclo_id.required' => 'El campo es requerido.',
            'centro_educativo_zona_geografica.required' => 'El campo es requerido.',
            'autorizacion_informacion.required' => 'El campo es requerido.',
            'consentimiento.required' => 'El campo es requerido.',
        ];
    }


    public function init(Pais $pais)
    {
        $this->pais = $pais;

        $this->dni_mask = '';
        $this->dni_placeholder = '';

        // Inicializar modelos vacios
        $this->inscripcion = new Inscripcion();

        $currentDate = Carbon::today($this->pais->timezone);

        // Validacion para no permitir valores menores a 18 años
        $this->fecha_nacimiento_max = $currentDate->subYears(18)->format('Y-m-d');

        $this->fecha_nacimiento_validacion = false;

        $this->gradoSuperior = false;

        $this->isPnc = false;

        $this->is_dgdp = false;

        $this->telephone_length = match($this->pais->slug) {
            'mexico' => PhoneLength::MEXICO,
            'guatemala' => PhoneLength::GUATEMALA,
            'el-salvador' => PhoneLength::EL_SALVADOR,
            'pnc' => PhoneLength::PNC,
            'honduras' => PhoneLength::HONDURAS,
            'costa-rica' => PhoneLength::COSTA_RICA,
            'panama' => PhoneLength::PANAMA,
            'colombia' => PhoneLength::COLOMBIA,
            default => PhoneLength::GUATEMALA,
        };

        $this->telephone_mask = match($this->pais->slug) {
            'mexico' => PhoneLength::MEXICO_MASK,
            'guatemala' => PhoneLength::GUATEMALA_MASK,
            'el-salvador' => PhoneLength::EL_SALVADOR_MASK,
            'pnc' => PhoneLength::PNC_MASK,
            'honduras' => PhoneLength::HONDURAS_MASK,
            'costa-rica' => PhoneLength::COSTA_RICA_MASK,
            'panama' => PhoneLength::PANAMA_MASK,
            'colombia' => PhoneLength::COLOMBIA_MASK,
            default => PhoneLength::GUATEMALA_MASK,
        };

        $this->ciudades = [];
        $this->sedes = [];
        $this->perteneceDepartamentos = [];
        $this->perteneceCiudades = [];
        $this->perteneceSede = [];
        $this->laboraCiudades = [];
        $this->discapacidadesSelect = [];

        $this->initSelectedValues();
    }

    public function initSelectedValues()
    {
        $this->institucionalEducacionSelect = [];
        $this->institucionalPoliciaSelect = [];
        $this->rangosSelect = [];
        $this->rangoOrganizacionesSelect = [];
        $this->rangoSaludSelect = [];
        $this->personalSaludSelect = [];
    }

    public function setInscripcion(Inscripcion $inscripcion)
    {
        $this->inscripcion = $inscripcion;

        $this->fecha_nacimiento = $inscripcion->fecha_nacimiento;
        $this->institucion_organizacion_id = $inscripcion->institucion_organizacion_id;
        $this->nombres = $inscripcion->nombres;
        $this->apellidos = $inscripcion->apellidos;
        $this->sexo = $inscripcion->sexo;
        $this->departamento_id = $inscripcion->departamento_id;
        $this->ciudad_id = $inscripcion->ciudad_id;
        $this->nacionalidad = $inscripcion->nacionalidad;
        $this->documento_identidad = $inscripcion->documento_identidad;
        $this->telefono = $inscripcion->telefono;
        $this->email = $inscripcion->email;
        $this->estudiando = $inscripcion->estudiando;
        $this->grado_id = $inscripcion->grado_id;
        $this->grado_seccion_id = $inscripcion->grado_seccion_id;
        $this->grado_jornada_id = $inscripcion->grado_jornada_id;
        $this->grado_alcanzado_id = $inscripcion->grado_alcanzado_id;
        $this->discapacidad = $inscripcion->discapacidad;
        $this->ha_participado_actividades_glasswing = $inscripcion->ha_participado_actividades_glasswing;
        $this->perfil_identificas = $inscripcion->perfil_identificas;
        $this->perfil_institucional_id = $inscripcion->perfil_institucional_id;
        $this->perfil_institucional_educacion_id = $inscripcion->perfil_institucional_educacion_id;
        $this->perfil_institucional_policia_id = $inscripcion->perfil_institucional_policia_id;
        $this->perfil_rango_id = $inscripcion->perfil_rango_id;
        $this->perfil_rango_organizacion_id = $inscripcion->perfil_rango_organizacion_id;
        $this->perfil_rango_salud_id = $inscripcion->perfil_rango_salud_id;
        $this->perfil_personal_salud_id = $inscripcion->perfil_personal_salud_id;
        $this->pertenece_departamento_id = $inscripcion->pertenece_departamento_id;
        $this->pertenece_ciudad_id = $inscripcion->pertenece_ciudad_id;
        $this->pertenece_sede_id = $inscripcion->pertenece_sede_id;
        $this->centro_educativo = $inscripcion->centro_educativo;
        $this->centro_educativo_tipo_id = $inscripcion->centro_educativo_tipo_id;
        $this->centro_educativo_cargo_id = $inscripcion->centro_educativo_cargo_id;
        $this->labora_departamento_id = $inscripcion->labora_departamento_id;
        $this->labora_municipio_id = $inscripcion->labora_municipio_id;
        $this->labora_aldea_id = $inscripcion->labora_aldea_id;
        $this->labora_caserio_id = $inscripcion->labora_caserio_id;
        $this->labora_codigo_sace = $inscripcion->labora_codigo_sace;
        $this->centro_educativo_jornada = $inscripcion->centro_educativo_jornada;
        $this->centro_educativo_nivel_id = $inscripcion->centro_educativo_nivel_id;
        $this->centro_educativo_ciclo_id = $inscripcion->centro_educativo_ciclo_id;
        $this->centro_educativo_zona_geografica = $inscripcion->centro_educativo_zona_geografica;
        $this->autorizacion_informacion = $inscripcion->autorizacion_informacion;
        $this->derechos_image_voz = $inscripcion->derechos_image_voz;
        $this->consentimiento = $inscripcion->consentimiento;
        $this->codigo_confirmacion = $inscripcion->codigo_confirmacion;
        $this->isPnc = $inscripcion->is_pnc;

        if ($inscripcion->discapacidades()->count()) {
            $this->discapacidadesSelect = $inscripcion->discapacidades->pluck('discapacidad_id')->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function() {
            $now = Carbon::now($this->pais->timezone);

            $this->inscripcion->fecha_nacimiento = $this->fecha_nacimiento;
            $this->inscripcion->institucion_organizacion_id = $this->institucion_organizacion_id;
            $this->inscripcion->nombres = $this->nombres;
            $this->inscripcion->apellidos = $this->apellidos;
            $this->inscripcion->sexo = $this->sexo;
            $this->inscripcion->pais_id = $this->pais->id;
            $this->inscripcion->departamento_id = $this->departamento_id;
            $this->inscripcion->ciudad_id = $this->ciudad_id;
            $this->inscripcion->nacionalidad = $this->nacionalidad;
            $this->inscripcion->telefono = $this->telefono;
            $this->inscripcion->email = $this->email;
            $this->inscripcion->estudiando = $this->estudiando;
            $this->inscripcion->grado_id = $this->grado_id;
            $this->inscripcion->grado_seccion_id = $this->grado_seccion_id;
            $this->inscripcion->grado_jornada_id = $this->grado_jornada_id;
            $this->inscripcion->grado_alcanzado_id = $this->grado_alcanzado_id;
            $this->inscripcion->discapacidad = $this->discapacidad;
            $this->inscripcion->ha_participado_actividades_glasswing = $this->ha_participado_actividades_glasswing;
            $this->inscripcion->perfil_identificas = $this->perfil_identificas;
            $this->inscripcion->perfil_institucional_id = $this->perfil_institucional_id;
            $this->inscripcion->perfil_institucional_educacion_id = $this->perfil_institucional_educacion_id;
            $this->inscripcion->perfil_institucional_policia_id = $this->perfil_institucional_policia_id;
            $this->inscripcion->perfil_rango_id = $this->perfil_rango_id;
            $this->inscripcion->perfil_rango_organizacion_id = $this->perfil_rango_organizacion_id;
            $this->inscripcion->perfil_rango_salud_id = $this->perfil_rango_salud_id;
            $this->inscripcion->perfil_personal_salud_id = $this->perfil_personal_salud_id;
            $this->inscripcion->pertenece_departamento_id = $this->pertenece_departamento_id;
            $this->inscripcion->pertenece_ciudad_id = $this->pertenece_ciudad_id;
            $this->inscripcion->pertenece_sede_id = $this->pertenece_sede_id;
            $this->inscripcion->centro_educativo = $this->centro_educativo;
            $this->inscripcion->centro_educativo_tipo_id = $this->centro_educativo_tipo_id;
            $this->inscripcion->centro_educativo_cargo_id = $this->centro_educativo_cargo_id;
            $this->inscripcion->labora_departamento_id = $this->labora_departamento_id;
            $this->inscripcion->labora_municipio_id = $this->labora_municipio_id;
            $this->inscripcion->labora_aldea_id = $this->labora_aldea_id;
            $this->inscripcion->labora_caserio_id = $this->labora_caserio_id;
            $this->inscripcion->labora_codigo_sace = $this->labora_codigo_sace;
            $this->inscripcion->centro_educativo_jornada = $this->centro_educativo_jornada;
            $this->inscripcion->centro_educativo_nivel_id = $this->centro_educativo_nivel_id;
            $this->inscripcion->centro_educativo_ciclo_id = $this->centro_educativo_ciclo_id;
            $this->inscripcion->centro_educativo_zona_geografica = $this->centro_educativo_zona_geografica;
            $this->inscripcion->autorizacion_informacion = $this->autorizacion_informacion;
            $this->inscripcion->derechos_image_voz = $this->derechos_image_voz;
            $this->inscripcion->consentimiento = $this->consentimiento;
            $this->inscripcion->active_at = $now;


            // DNI completo para todos los paises a excepcion de PNC
            $dni = trim($this->documento_identidad);

            if ($this->isPnc) {
                $dni = $this->buildDocumentoIdentidadParaPnc();
                $this->inscripcion->is_pnc = true;
            }
            else {
                $this->inscripcion->is_pnc = false;
            }

            $this->inscripcion->documento_identidad = $dni;


            $this->inscripcion->save();

            if ($this->inscripcion->discapacidades()->count()) {
                $this->inscripcion->discapacidades()->each(fn ($discapacidad) => $discapacidad->delete());
            }

            if ($this->inscripcion->discapacidad == 1) {
                foreach ($this->discapacidadesSelect as $value) {
                    $this->inscripcion->discapacidades()->create([
                        'discapacidad_id' => $value,
                    ]);
                }
            }

            // Agregar nombre completo en la notificacion de proceso finalizado
            $this->fullName = $this->inscripcion->nombres . ' ' . $this->inscripcion->apellidos;

            if (empty($this->inscripcion->codigo_confirmacion)) {
                $this->codigo_confirmacion = TicketCode::generateFor($this->inscripcion);
                $this->inscripcion->codigo_confirmacion = $this->codigo_confirmacion;
                $this->inscripcion->save();
            }

            $this->customReset();
        });
    }

    public function buildDocumentoIdentidadParaPnc()
    {
        if ($this->nombres && $this->apellidos && $this->documento_identidad && $this->pertenece_sede_id) {
            $escuela = EscuelaGWDATA::find($this->pertenece_sede_id);
            $codigoEscuela = strpos($escuela->code, ',') !== false ? explode(',', $escuela->code)[1] : $escuela->code;

            $fullName = $this->removeAccents($this->nombres . $this->apellidos);
            $shortName = substr(str_replace(' ', '', $fullName), 0, 10);

            return strtoupper($shortName) . '/' . $codigoEscuela . '/' . $this->documento_identidad;
        }

        return null;
    }

    public function removeAccents($text)
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

        $text = strtr($text, [
            '~' => '', '`' => '', "'" => '', '"' => '', '^' => '', '´' => '', '¨' => ''
        ]);

        return $text;
    }

    public function customReset()
    {
        $this->reset([
            'ciudades',
            'sedes',
            'institucionalEducacionSelect',
            'institucionalPoliciaSelect',
            'rangosSelect',
            'rangoOrganizacionesSelect',
            'rangoSaludSelect',
            'personalSaludSelect',
            'perteneceDepartamentos',
            'perteneceCiudades',
            'perteneceSede',
            'laboraCiudades',
            'fecha_nacimiento',
            'institucion_organizacion_id',
            'nombres',
            'apellidos',
            'sexo',
            'departamento_id',
            'ciudad_id',
            'nacionalidad',
            'documento_identidad',
            'telefono',
            'email',
            'estudiando',
            'grado_id',
            'grado_seccion_id',
            'grado_jornada_id',
            'grado_alcanzado_id',
            'discapacidad',
            'discapacidadesSelect',
            'ha_participado_actividades_glasswing',
            'perfil_identificas',
            'perfil_institucional_id',
            'perfil_institucional_educacion_id',
            'perfil_institucional_policia_id',
            'perfil_rango_id',
            'perfil_rango_organizacion_id',
            'perfil_rango_salud_id',
            'perfil_personal_salud_id',
            'pertenece_departamento_id',
            'pertenece_ciudad_id',
            'pertenece_sede_id',
            'centro_educativo',
            'centro_educativo_tipo_id',
            'centro_educativo_cargo_id',
            'labora_departamento_id',
            'labora_municipio_id',
            'labora_aldea_id',
            'labora_caserio_id',
            'labora_codigo_sace',
            'centro_educativo_jornada',
            'centro_educativo_nivel_id',
            'centro_educativo_ciclo_id',
            'centro_educativo_zona_geografica',
            'autorizacion_informacion',
            'derechos_image_voz',
            'consentimiento',
            'edad',
        ]);
    }

    public function removerPoliciaMilitar()
    {
        if ($this->institucionalPoliciaSelect->has(12)) {
            $this->institucionalPoliciaSelect->forget(12);
        }
    }

    public function removerPoliciaNacionalDuplicados()
    {
        $this->rangosSelect->each(function ($item, $key) {
            if ($this->institucionalPoliciaSelect->search($item)) {
                $this->rangosSelect->forget($key);
            }
        });
    }

    public function removerPersonalSaludDuplicados()
    {
        $this->personalSaludSelect->each(function ($item, $key) {
            if ($this->rangoSaludSelect->search($item)) {
                $this->personalSaludSelect->forget($key);
            }
        });
    }

    public function removerGestorpedagogicoPorPais()
    {
        if ($this->pais->slug != 'el-salvador') {
            $this->institucionalEducacionSelect->each(function ($item, $key) {
                if (str_contains('Gestor/a pedagógico', $item)) {
                    $this->institucionalEducacionSelect->forget($key);
                }
            });
        }
    }
}
