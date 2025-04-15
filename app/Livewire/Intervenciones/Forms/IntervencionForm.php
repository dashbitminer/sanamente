<?php

namespace App\Livewire\Intervenciones\Forms;

use Livewire\Form;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use App\Dni;
use App\Facades\TicketCode;
use App\Rules\DocumentoIdentidadRule;
use App\Models\Pais;
use App\Models\Intervencion;
use App\Models\IntervencionParticipante;
use App\Models\ProtocoloSanamente;
use App\Models\ReferenciaIntervencion;
use App\Models\PrimerAuxilioPsicologico;
use App\Models\IntervencionImage;
use Carbon\Carbon;
use App\PhoneLength;

class IntervencionForm extends Form
{
    use WithFileUploads, Dni;

    const DNI_TITLE = 'Escribe tu número documento de identidad:';

    public Pais $pais;

    public ?Intervencion $intervencion;

    public ?IntervencionParticipante $intervencionParticipante;

    public $showValidationErrorIndicator = false;

    public $ciudades;

    public $sedes;

    public $menor = false;

    public $dni_mask;

    public $dni_placeholder;

    public $dni_title;

    public $fecha_nacimiento_max;

    public $fecha_intervencion_max;


    // Especifica si se va a crear o editar
    public $mode = 'create';


    // Verifica si el tiempo de "Total de Intervencion" es negativo
    public $is_negative_total_intervencion_hora;

    public $is_negative_total_intervencion_minuto;


    // Restringir digitos de numero telefonico por pais
    public $telephone_length;


    // Datos de la tabla intervencion_participantes
    #[Validate]
    public $nombres;

    #[Validate]
    public $apellidos;

    #[Validate]
    public $documento_identidad;

    #[Validate]
    public $nacionalidad;

    #[Validate]
    public $fecha_nacimiento;

    #[Validate]
    public $sexo;

    public $discapacidad;

    public $discapacidad_id;

    public $telefono;

    public $email;


    // Datos de la tabla intervenciones
    // 1:Individual, 2:Grupal
    #[Validate]
    public $tipo_intervencion;

    public $cantidad_hombres;

    public $cantidad_mujeres;

    #[Validate]
    public $primera_intervencion;

    #[Validate]
    public $compartir_informacion;

    #[Validate]
    public $departamento_id;

    #[Validate]
    public $ciudad_id;

    public $perfil_participante_id;

    #[Validate]
    public $perfil_participante;

    #[Validate]
    public $sede_id;

    #[Validate]
    public $fecha_intervencion;

    #[Validate]
    public $inicio_intervencion;

    #[Validate]
    public $fin_intervencion;

    #[Validate]
    public $pauso_intervencion;

    #[Validate]
    public $total_intervencion;

    #[Validate]
    public $tipo_intervencion_id;

    #[Validate]
    public $persona_referida;

    public $protocolo_sanamente_id;

    public $primer_auxilio_psicologico_id;

    public $referencia_intervencion_id;

    public $participar_proceso_evaluacion;

    public $codigo_confirmacion;

    public $comentario;

    public $comentario_apoyo_psicosocial;


    // Datos de la tabla intervencion_tipo_otra_intervencion
    #[Validate]
    public $tipo_otra_intervencion_id;


    // Datos de la tabla sanamente_tipo_psicoeducaciones
    #[Validate]
    public $tipo_psicoeducacion_id;


    // Datos de la tabla sanamente_estrategias
    #[Validate]
    public $estrategia_id;


    // Datos de la tabla protocolo_sanamentes
    #[Validate]
    public $pauso_protocolo;

    #[Validate]
    public $pauso_protocolo_id;

    #[Validate]
    public $pauso_protocolo_otros;

    #[Validate]
    public $consentimiento;

    public $consentimiento_archivo;

    public $protocolo_comentario;


    // Datos de la tabla primeros_auxilios_psicologicos
    public $psicologicos_comentario;

    public $psicologicos_consentimiento;

    public $psicologicos_consentimiento_upload;


    // Datos de la tabla referencias_intervencion_procesos
    #[Validate]
    public $proceso_id;


    // Datos de la tabla referencia_intervenciones
    #[Validate]
    public $conceptualizacion_problema;

    #[Validate]
    public $razon_intervencion_id;

    #[Validate]
    public $razon_otro;

    #[Validate]
    public $proceso_otro;

    #[Validate]
    public $referencia;

    public $referencia_uploaded;

    public $referencias_comentario;


    // Multiple imagenes para protocolo sanamente y referencias
    #[Validate]
    public $protocolo_images;

    public $protocolo_images_uploaded;

    #[Validate]
    public $referencia_images;

    public $referencia_images_uploaded;


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
            'tipo_intervencion' => 'required',
            'cantidad_hombres' => 'required_if:tipo_intervencion,2',
            'cantidad_mujeres' => 'required_if:tipo_intervencion,2',
            'primera_intervencion' => 'required',
            'compartir_informacion' => 'required_if:tipo_intervencion,1',
            'nacionalidad' => Rule::requiredIf(fn() => $this->compartir_informacion == '1'),
            'nombres' => Rule::when(
                fn() => $this->compartir_informacion == '1',
                ['required', 'min:3']
            ),
            'apellidos' => Rule::when(
                fn() => $this->compartir_informacion == '1',
                ['required', 'min:3']
            ),
            'fecha_nacimiento' => Rule::when(
                fn() => $this->compartir_informacion == '1',
                ['required', 'date']
            ),
            'sexo' => 'required_if:tipo_intervencion,1',
            'discapacidad' => 'required_if:tipo_intervencion,1',
            'discapacidad_id' => 'required_if:discapacidad,1',
            'departamento_id' => 'required',
            'ciudad_id' => 'required',
            'sede_id' => 'required',
            'perfil_participante_id' => 'required_if:tipo_intervencion,1',
            'perfil_participante' => 'required_if:tipo_intervencion,2',
            'fecha_intervencion' => 'required',
            'tipo_intervencion_id' => 'required',
            'persona_referida' => Rule::requiredIf(function () {
                return $this->pais->tipoIntervencion()
                    ->whereIn('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->whereIn('tipo_intervenciones.slug', [
                        'protocolo-sanamente',
                        'primeros-auxilios-psicologicos'
                    ])
                    ->count()
                    && $this->tipo_intervencion != 2;
            }),
            'tipo_otra_intervencion_id' => Rule::requiredIf(function () {
                return $this->pais->tipoIntervencion()
                    ->whereIn('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', 'primeros-auxilios-psicologicos')
                    ->count();
            }),

            'pauso_protocolo' => Rule::requiredIf(function () {
                return $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', 'protocolo-sanamente')
                    ->count();
            }),
            'pauso_protocolo_id' => Rule::requiredIf(fn() => $this->pauso_protocolo == '1'),
            'pauso_protocolo_otros' => Rule::requiredIf(function () {
                return $this->pais->pausoProtocolo()
                    ->where('pauso_protocolos.id', $this->pauso_protocolo_id)
                    ->where('pauso_protocolos.slug', 'otro')
                    ->count();
            }),
            'consentimiento' => Rule::when(
                $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', 'protocolo-sanamente')
                    ->count() && $this->mode == 'create',
                [
                    'required',
                    'mimes:pdf,png,jpeg,jpg',
                    'max:5000',
                ]
            ),
            'tipo_psicoeducacion_id' => Rule::requiredIf(function () {
                return $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', 'protocolo-sanamente')
                    ->count();
            }),
            'estrategia_id' => Rule::requiredIf(function () {
                return $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', 'protocolo-sanamente')
                    ->count();
            }),

            'razon_intervencion_id' => Rule::requiredIf(function () {
                return $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', 'referencia')
                    ->count();
            }),
            'razon_otro' => Rule::requiredIf(function () {
                return $this->pais->razonIntervencion()
                    ->where('razon_intervenciones.id', $this->razon_intervencion_id)
                    ->where('razon_intervenciones.slug', 'otro')
                    ->count();
            }),
            'proceso_id' => [
                Rule::when(
                    $this->pais->tipoIntervencion()
                        ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                        ->where('tipo_intervenciones.slug', 'referencia')
                        ->count(),
                    ['required']
                ),
                Rule::when($this->persona_referida == '1',  ['required']),
            ],
            'proceso_otro' => Rule::requiredIf(function () {
                return $this->pais->procesos()
                    ->whereIn('procesos.id', $this->proceso_id)
                    ->whereLike('procesos.slug', 'otro')
                    ->count();
            }),

            'inicio_intervencion' => Rule::requiredIf(function () {
                return $this->tipo_intervencion_id != null && $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', '!=', 'referencia')
                    ->count();
            }),
            'fin_intervencion' => Rule::requiredIf(function () {
                return $this->tipo_intervencion_id != null && $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', '!=', 'referencia')
                    ->count();
            }),
            'total_intervencion' => Rule::when(
                (preg_match('/^-\d+(\.\d+)?/', $this->total_intervencion) || $this->total_intervencion == '0h 0m') ||
                ($this->is_negative_total_intervencion_hora == true || $this->is_negative_total_intervencion_minuto == true),
                ['date_format:G\h i\m']
            ),
            'pauso_intervencion' => Rule::when($this->pais->pausoProtocolo()
                ->where('pauso_protocolos.id', $this->pauso_protocolo_id)
                ->whereIn('pauso_protocolos.slug', [
                    'interrupcion-por-proceso-de-la-sede',
                    'otro'
                ])
                ->count(), ['required', 'date_format:H:i']
            ),

            'conceptualizacion_problema' => Rule::requiredIf(function () {
                return $this->pais->tipoIntervencion()
                    ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
                    ->where('tipo_intervenciones.slug', 'referencia')
                    ->count();
            }),

            'referencia' => Rule::when(
                !empty($this->referencia),
                [
                    'mimes:pdf,png,jpeg,jpg',
                    'max:5000',
                ]
            ),

            'referencia_images' => Rule::when(
                !empty($this->referencia_images),
                [
                    'mimes:pdf,png,jpeg,jpg',
                    'max:5000',
                ]
            ),

            'protocolo_images' => Rule::when(
                !empty($this->protocolo_images),
                [
                    'mimes:pdf,png,jpeg,jpg',
                    'max:5000',
                ]
            ),

            // 'psicologicos_consentimiento_upload' => Rule::when(
            //     $this->pais->tipoIntervencion()
            //         ->where('tipo_intervenciones.id', $this->tipo_intervencion_id)
            //         ->where('tipo_intervenciones.slug', 'primeros-auxilios-psicologicos')
            //         ->count() && $this->mode == 'create',
            //     [
            //         'required',
            //         'mimes:pdf,png,jpeg,jpg',
            //         'max:5000',
            //     ]
            // ),
        ];
    }

    public function messages()
    {
        return [
            'tipo_intervencion.required' => 'El campo tipo de intervencion es requerido.',
            'cantidad_hombres.required' => 'El campo cantidad de hombres es requerido.',
            'cantidad_mujeres.required' => 'El campo cantidad de mujeres es requerido.',
            'primera_intervencion.required' => 'El campo primera intervencion es requerido.',
            'compartir_informacion.required' => 'El campo compartir informacion es requerido.',
            'nombres.required' => 'El campo nombres es requerido.',
            'nombres.min' => 'El campo nombres debe de ser de al menos 3 caracteres.',
            'apellidos.required' => 'El campo apellidos es requerido.',
            'apellidos.min' => 'El campo apellidos debe de ser de al menos 3 caracteres.',
            'documento_identidad.required' => 'El campo documento de identidad es requerido.',
            'nacionalidad.required' => 'El campo nacionalidad es requerido.',
            'fecha_nacimiento.required' => 'El campo fecha de nacimiento es requerido.',
            'sexo.required' => 'El campo sexo es requerido.',
            'discapacidad.required' => 'El campo discapacidad es requerido.',
            'discapacidad_id.required' => 'El campo discapacidades es requerido.',
            'telefono.required' => 'El campo telefono es requerido.',
            'telefono.size' => 'El telefono debe tener al menos 8 digitos.',
            'email.required' => 'El campo email es requerido.',
            'departamento_id.required' => 'El campo departamento es requerido.',
            'ciudad_id.required' => 'El campo ciudad es requerido.',
            'perfil_participante_id.required' => 'El campo perfil de participante es requerido.',
            'perfil_participante.required' => 'El campo perfil de participante es requerido.',
            'sede_id.required' => 'El campo sede es requerido.',
            'fecha_intervencion.required' => 'El campo fecha de intervencion es requerido.',
            'tipo_intervencion_id.required' => 'El campo tipo de intervencion es requerido.',
            'tipo_otra_intervencion_id.required' => 'El campo tipo de otras intervenciones es requerido.',
            'pauso_protocolo.required' => 'El campo pauso protocolo es requerido.',
            'pauso_protocolo_id.required' => 'El campo porque es requerido.',
            'pauso_protocolo_otros.required' => 'El campo pauso protocolo otros es requerido.',
            'persona_referida.required' => 'El campo persona de referida es requerido.',
            'consentimiento.required' => 'El campo consentimiento es requerido.',
            'consentimiento.max' => 'El archivo debe de tener máximo 5mb.',
            'consentimiento.mimes' => 'Tipo de archivo no válido.',
            'tipo_psicoeducacion_id.required' => 'El campo tipo de psicoeducacion es requerido.',
            'estrategia_id.required' => 'El campo estrategia es requerido.',
            'razon_intervencion_id.required' => 'El campo razon de intervencion es requerido.',
            'razon_otro.required' => 'El campo razon otro es requerido.',
            'proceso_id.required' => 'El campo proceso es requerido.',
            'proceso_otro.required' => 'El campo proceso otro es requerido.',
            'referencia.mimes' => 'Tipo de archivo no válido.',
            'referencia.max' => 'El archivo debe de tener máximo 5mb.',
            'inicio_intervencion.required' => 'El campo inicio de intervención es requerido.',
            'fin_intervencion.required' => 'El campo fin de intervención es requerido.',
            'total_intervencion.required' => 'El campo total intervención es requerido.',
            'total_intervencion.date_format' => 'Por favor, revise el tiempo de la intervención.',
            'pauso_intervencion.required' => 'El campo cuánto tiempo se pausó el protocolo es requerido.',
            'pauso_intervencion.date_format' => 'Ingrese una hora y minutos con el formato Hora:Minuto (ej.: 23:59).',
            'conceptualizacion_problema.required' => 'El campo conceptualizacion de problema es requerido.',
            'referencia_images.max' => 'Uno de los archivos debe de tener máximo 5mb.',
            'referencia_images.mimes' => 'Uno de los archivos tiene un tipo de archivo no válido.',
            'protocolo_images.max' => 'Uno de los archivos debe de tener máximo 5mb.',
            'protocolo_images.mimes' => 'Uno de los archivos tiene un tipo de archivo no válido.',
            'psicologicos_consentimiento_upload.max' => 'Uno de los archivos debe de tener máximo 5mb.',
            'psicologicos_consentimiento_upload.mimes' => 'Uno de los archivos tiene un tipo de archivo no válido.',
        ];
    }


    public function init(Pais $pais)
    {
        $this->ciudades = [];
        $this->sedes = [];
        $this->tipo_intervencion_id = [];
        $this->tipo_otra_intervencion_id = [];
        $this->tipo_psicoeducacion_id = [];
        $this->estrategia_id = [];
        $this->proceso_id = [];
        $this->total_intervencion = '0m';
        $this->pais = $pais;
        $this->protocolo_images = [];
        $this->protocolo_images_uploaded = [];
        $this->referencia_images = [];
        $this->referencia_images_uploaded = [];

        $this->discapacidad_id = [];
        $this->perfil_participante = [];

        // Inicializar modelos vacios
        $this->intervencion = new Intervencion();
        $this->intervencionParticipante = new IntervencionParticipante();

        $this->dni_mask = '';
        $this->dni_placeholder = '';
        $this->dni_title = self::DNI_TITLE;

        $currentDate = Carbon::today($this->pais->timezone);

        // Validacion para que la fecha de intervencion no sea mayor a la fecha actual
        $this->fecha_intervencion_max = $currentDate->format('Y-m-d');

        // Validacion para no permitir valores menores a 18 años
        $this->fecha_nacimiento_max = $this->fecha_intervencion_max;

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
    }

    public function setIntervencionParticipante(IntervencionParticipante $intervencionParticipante) {
        $this->intervencionParticipante = $intervencionParticipante;

        $this->nombres = $intervencionParticipante->nombres;
        $this->apellidos = $intervencionParticipante->apellidos;
        $this->documento_identidad = $intervencionParticipante->documento_identidad;
        $this->nacionalidad = $intervencionParticipante->nacionalidad;
        $this->fecha_nacimiento = $intervencionParticipante->fecha_nacimiento;
        $this->telefono = $intervencionParticipante->telefono;
        $this->sexo = $intervencionParticipante->sexo;
        $this->email = $intervencionParticipante->email;
        $this->codigo_confirmacion = $intervencionParticipante->codigo_confirmacion;

        if ($intervencionParticipante->intervenciones->count()) {
            $intervenciones = $intervencionParticipante->intervenciones->last();

            $this->perfil_participante_id = $intervenciones->perfil_participante_id;
            $this->departamento_id = $intervenciones->departamento_id;
            $this->ciudad_id = $intervenciones->ciudad_id;
            $this->sede_id = $intervenciones->sede_id;
        }
    }

    public function setIntervencion(Intervencion $intervencion) {
        $this->intervencion = $intervencion;

        $this->tipo_intervencion = $intervencion->tipo_intervencion;
        $this->cantidad_hombres = $intervencion->cantidad_hombres;
        $this->cantidad_mujeres = $intervencion->cantidad_mujeres;
        $this->primera_intervencion = $intervencion->primera_intervencion;
        $this->compartir_informacion = $intervencion->compartir_informacion;
        $this->departamento_id = $intervencion->departamento_id;
        $this->ciudad_id = $intervencion->ciudad_id;
        $this->sede_id = $intervencion->sede_id;
        $this->perfil_participante_id = $intervencion->perfil_participante_id;
        $this->perfil_participante = json_decode($intervencion->perfil_participante);
        $this->fecha_intervencion = $intervencion->fecha_intervencion;
        $this->inicio_intervencion = $intervencion->inicio_intervencion;
        $this->fin_intervencion = $intervencion->fin_intervencion;
        $this->pauso_intervencion = $intervencion->pauso_intervencion;
        $this->total_intervencion = $intervencion->total_intervencion;
        $this->persona_referida = $intervencion->persona_referida;
        $this->protocolo_sanamente_id = $intervencion->protocolo_sanamente_id;
        $this->primer_auxilio_psicologico_id = $intervencion->primer_auxilio_psicologico_id;
        $this->referencia_intervencion_id = $intervencion->referencia_intervencion_id;
        $this->discapacidad = $intervencion->discapacidad;
        $this->discapacidad_id = json_decode($intervencion->discapacidad_id);
        $this->participar_proceso_evaluacion = $intervencion->participar_proceso_evaluacion;
        $this->comentario = $intervencion->comentario;
        $this->comentario_apoyo_psicosocial = $intervencion->comentario_apoyo_psicosocial;
        $this->user_id = $intervencion->user_id;

        $this->tipo_intervencion_id = $intervencion->tipoIntervencion->modelKeys();
    }

    public function loadByTipoIntervencion(Intervencion $intervencion)
    {
        $intervencion->load([
            "intervencionParticipante",
            "tipoIntervencion",
            "tipoOtraIntervencion",
            "protocoloSanamente",
            "protocoloSanamente.tipoPsicoeducacion",
            "protocoloSanamente.estrategia",
            "primerAuxilioPsicologico",
            "referenciaIntervencion",
            "referenciaIntervencion.razonIntervencion",
            "referenciaIntervencion.referenciasProcesos",
            "referenciaIntervencion.intervencionImages",
        ]);

        $this->setIntervencion($intervencion);
        $this->setIntervencionParticipante($intervencion->intervencionParticipante);

        if ($intervencion->tipoOtraIntervencion()->count()) {
            $this->tipo_otra_intervencion_id = $intervencion->tipoOtraIntervencion()
                ->pluck('tipo_otra_intervencion_id')
                ->toArray();

            // Si el participante selecciono el ID 3, se va a sustituir por el ID 2 ya que es la misma opcion
            // y solo se muestra el ID 2 en la lista de opciones.
            if (count($this->tipo_otra_intervencion_id) == 1 && in_array(3, $this->tipo_otra_intervencion_id)) {
                $this->tipo_otra_intervencion_id = [2];
            }
        }

        if ($intervencion->protocolo_sanamente_id) {
            $protocoloSanamente = $intervencion->protocoloSanamente;

            $this->pauso_protocolo = $protocoloSanamente->pauso_protocolo;
            $this->pauso_protocolo_id = $protocoloSanamente->pauso_protocolo_id;
            $this->pauso_protocolo_otros = $protocoloSanamente->pauso_protocolo_otros;
            $this->protocolo_comentario = $protocoloSanamente->comentario;
            // Solo para mostrar el archivo que se subio.
            $this->consentimiento_archivo = $protocoloSanamente->consentimiento;

            if ($protocoloSanamente->tipoPsicoeducacion()->count()) {
                $this->tipo_psicoeducacion_id = $protocoloSanamente->tipoPsicoeducacion->modelKeys();
            }

            if ($protocoloSanamente->estrategia()->count()) {
                $this->estrategia_id = $protocoloSanamente->estrategia->modelKeys();
            }

            if ($protocoloSanamente->intervencionImages()->count()) {
                $this->protocolo_images_uploaded = $protocoloSanamente->intervencionImages()
                    ->pluck('url', 'id')
                    ->toArray();

                foreach ($this->protocolo_images_uploaded as $key => $value) {
                    $this->protocolo_images[$key] = null;
                }
            }
        }

        if ($intervencion->primer_auxilio_psicologico_id) {
            $this->psicologicos_comentario = $intervencion->primerAuxilioPsicologico->comentario;
            $this->psicologicos_consentimiento = $intervencion->primerAuxilioPsicologico->consentimiento;
        }

        if ($intervencion->referencia_intervencion_id) {
            $referenciaIntervencion = $intervencion->referenciaIntervencion;

            $this->conceptualizacion_problema = $referenciaIntervencion->conceptualizacion_problema;
            $this->razon_intervencion_id = $referenciaIntervencion->razon_intervencion_id;
            $this->razon_otro = $referenciaIntervencion->razon_otro;
            $this->proceso_otro = $referenciaIntervencion->proceso_otro;
            $this->referencias_comentario = $referenciaIntervencion->comentario;
            // Solo para mostrar el archivo que se subio.
            $this->referencia_uploaded = $referenciaIntervencion->referencia;

            if ($referenciaIntervencion->referenciasProcesos()->count()) {
                $this->proceso_id = $referenciaIntervencion->referenciasProcesos->modelKeys();
            }

            if ($referenciaIntervencion->intervencionImages()->count()) {
                $this->referencia_images_uploaded = $referenciaIntervencion->intervencionImages()
                    ->pluck('url', 'id')
                    ->toArray();

                foreach ($this->referencia_images_uploaded as $key => $value) {
                    $this->referencia_images[$key] = null;
                }
            }
        }

        // Cargar placeholder para el documento unico de indentidad
        if ($this->nacionalidad === IntervencionParticipante::NACIONAL) {
            $this->dni_placeholder = $this->setCountry($this->pais)->getPlaceholder();
            $this->dni_mask = $this->setCountry($this->pais)->getMask();
            $this->dni_title = 'Escribe tu número documento unico de identidad:';
        }
    }

    /**
     * Condicion: Primera Intervencion = No && Compartir Informacion = Si
     *
     * @return bool
     */
    public function isCondicion1(): bool
    {
        return $this->primera_intervencion == '0' && $this->compartir_informacion == '1';
    }

    /**
     * Condicion: Primera Intervencion = Si && Compartir Informacion = No
     *
     * @return bool
     */
    public function isCondicion2(): bool
    {
        return $this->primera_intervencion == '1' && $this->compartir_informacion == '0';
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function() {

            //dd($this->pauso_intervencion);

            $now = Carbon::now($this->pais->timezone);

            $this->intervencionParticipante->nombres = $this->nombres;
            $this->intervencionParticipante->apellidos = $this->apellidos;
            $this->intervencionParticipante->documento_identidad = $this->documento_identidad;
            $this->intervencionParticipante->fecha_nacimiento = $this->fecha_nacimiento;
            $this->intervencionParticipante->nacionalidad = $this->nacionalidad;
            $this->intervencionParticipante->sexo = $this->sexo;
            $this->intervencionParticipante->telefono = $this->telefono;
            $this->intervencionParticipante->email = $this->email;
            $this->intervencionParticipante->active_at = $now;

            if (empty($this->intervencionParticipante->codigo_confirmacion)) {
                $this->intervencionParticipante->created_at = $now;
            }

            $this->intervencionParticipante->save();

            $this->intervencion->intervencion_participante_id = $this->intervencionParticipante->id;
            $this->intervencion->tipo_intervencion = $this->tipo_intervencion;
            $this->intervencion->cantidad_hombres = $this->cantidad_hombres;
            $this->intervencion->cantidad_mujeres = $this->cantidad_mujeres;
            $this->intervencion->primera_intervencion = $this->primera_intervencion;
            $this->intervencion->compartir_informacion = $this->compartir_informacion;
            $this->intervencion->pais_id = $this->pais->id;
            $this->intervencion->departamento_id = $this->departamento_id;
            $this->intervencion->ciudad_id = $this->ciudad_id;
            $this->intervencion->sede_id = $this->sede_id;
            $this->intervencion->perfil_participante_id = $this->perfil_participante_id;
            $this->intervencion->perfil_participante = json_encode($this->perfil_participante);
            $this->intervencion->fecha_intervencion = $this->fecha_intervencion;
            $this->intervencion->inicio_intervencion = $this->inicio_intervencion;
            $this->intervencion->fin_intervencion = $this->fin_intervencion;
            $this->intervencion->pauso_intervencion = isset($this->pauso_intervencion) && !empty($this->pauso_intervencion) ? $this->pauso_intervencion : null;
            $this->intervencion->total_intervencion = $this->total_intervencion;
            $this->intervencion->persona_referida = $this->persona_referida;
            $this->intervencion->participar_proceso_evaluacion = $this->participar_proceso_evaluacion;
            $this->intervencion->comentario = $this->comentario;
            $this->intervencion->comentario_apoyo_psicosocial = $this->comentario_apoyo_psicosocial;
            $this->intervencion->save();

            // Save Tipo de Intervencion
            $this->intervencion->tipoIntervencion()->sync($this->tipo_intervencion_id);
            $tipoIntervencion = $this->intervencion->tipoIntervencion()->pluck('slug');

            if ($tipoIntervencion->search('protocolo-sanamente') !== false) {
                $protocoloSanamente = $this->intervencion->protocoloSanamente()
                    ->updateOrCreate(
                        ['id' => $this->intervencion->protocolo_sanamente_id],
                        [
                            'pauso_protocolo' => $this->pauso_protocolo,
                            'pauso_protocolo_id' => $this->pauso_protocolo_id,
                            'pauso_protocolo_otros' => $this->pauso_protocolo_otros,
                            'comentario' => $this->protocolo_comentario,
                            'active_at' => $now,
                        ]
                    );

                $protocoloSanamente->tipoPsicoeducacion()->sync($this->tipo_psicoeducacion_id);
                $protocoloSanamente->estrategia()->sync($this->estrategia_id);

                if ($this->consentimiento) {
                    $protocoloSanamente->consentimiento = $this->consentimiento
                        ->store('intervenciones/protocolo-sanamente', 's3');
                    $protocoloSanamente->save();
                }

                // Si la persona fue referida
                if ($this->persona_referida == '1') {
                    $this->referencia_intervencion_id = $this->saveReferencia($now);
                }

                if (!empty($this->protocolo_images)) {
                    foreach ($this->protocolo_images as $key => $value) {
                        $url = null;

                        if ($this->protocolo_images[$key]) {
                            $url = $this->protocolo_images[$key]
                                ->store('intervenciones/protocolo-sanamente', 's3');
                        }
                        else if (!empty($this->protocolo_images_uploaded[$key])) {
                            $url = $this->protocolo_images_uploaded[$key];
                        }

                        if (!empty($url)) {
                            $protocoloSanamente->intervencionImages()
                                ->updateOrCreate(
                                    ['id' => $key],
                                    ['url' => $url]
                                );
                        }
                    }
                }

                $this->protocolo_sanamente_id = $protocoloSanamente->id;
            }


            if ($tipoIntervencion->search('primeros-auxilios-psicologicos') !== false) {
                $primerosAuxiliosPsicologicos = $this->intervencion->primerAuxilioPsicologico()
                    ->updateOrCreate(
                        ['id' => $this->intervencion->primer_auxilio_psicologico_id],
                        [
                            'comentario' => $this->psicologicos_comentario,
                            'active_at' => $now,
                        ]
                    );

                $this->intervencion->tipoOtraIntervencion()->syncWithPivotValues(
                    $this->tipo_otra_intervencion_id,
                    ['active_at' => $now]
                );

                // Si la persona fue referida
                if ($this->persona_referida == '1'
                    && ($this->referencia_intervencion_id == null || $this->mode == 'edit')) {
                    $this->referencia_intervencion_id = $this->saveReferencia($now);
                }

                if ($this->psicologicos_consentimiento_upload) {
                    $primerosAuxiliosPsicologicos->consentimiento = $this->psicologicos_consentimiento_upload
                        ->store('intervenciones/primeros-auxilios-psicologicos', 's3');
                    $primerosAuxiliosPsicologicos->save();
                }

                $this->primer_auxilio_psicologico_id = $primerosAuxiliosPsicologicos->id;
            }


            if ($tipoIntervencion->search('referencia') !== false
                && ($this->referencia_intervencion_id == null || $this->mode == 'edit')) {
                $this->referencia_intervencion_id = $this->saveReferencia($now);
            }


            $this->intervencion->protocolo_sanamente_id = $this->protocolo_sanamente_id;
            $this->intervencion->primer_auxilio_psicologico_id = $this->primer_auxilio_psicologico_id;
            $this->intervencion->referencia_intervencion_id = $this->referencia_intervencion_id;
            $this->intervencion->discapacidad = $this->discapacidad;
            $this->intervencion->discapacidad_id = json_encode($this->discapacidad_id);
            $this->intervencion->active_at = $now;

            if ($this->mode === 'create') {
                $this->intervencion->created_at = $now;
            }

            $this->intervencion->save();

            if (empty($this->intervencionParticipante->codigo_confirmacion)) {
                $this->codigo_confirmacion = TicketCode::generateFor($this->intervencion);
                $this->intervencionParticipante->codigo_confirmacion = $this->codigo_confirmacion;
                $this->intervencionParticipante->save();
            }

            $this->customReset();

        });
    }

    private function saveReferencia($now)
    {
        $referenciaIntervencion = $this->intervencion->referenciaIntervencion()
            ->updateOrCreate(
                ['id' => $this->intervencion->referencia_intervencion_id],
                [
                    'conceptualizacion_problema' => $this->conceptualizacion_problema,
                    'razon_intervencion_id' => $this->razon_intervencion_id,
                    'razon_otro' => $this->razon_otro,
                    'proceso_otro' => $this->proceso_otro,
                    'comentario' => $this->referencias_comentario,
                    'active_at' => $now,
                ]
            );

        if ($this->referencia) {
            $referenciaIntervencion->referencia = $this->referencia
                ->store('intervenciones/referencias', 's3');
            $referenciaIntervencion->save();
        }

        $referenciaIntervencion->referenciasProcesos()->syncWithPivotValues(
            $this->proceso_id,
            ['active_at' => $now]
        );

        if (!empty($this->referencia_images)) {
            foreach ($this->referencia_images as $key => $value) {
                $url = null;

                if ($this->referencia_images[$key]) {
                    $url = $this->referencia_images[$key]
                        ->store('intervenciones/referencias', 's3');
                }
                else if (!empty($this->referencia_images_uploaded[$key])) {
                    $url = $this->referencia_images_uploaded[$key];
                }

                if (!empty($url)) {
                    $referenciaIntervencion->intervencionImages()
                        ->updateOrCreate(
                            ['id' => $key],
                            ['url' => $url]
                        );
                }
            }
        }

        return $referenciaIntervencion->id;
    }

    public function customReset()
    {
        $this->reset([
            'nombres',
            'apellidos',
            'documento_identidad',
            'nacionalidad',
            'fecha_nacimiento',
            'sexo',
            'telefono',
            'email',
            'primera_intervencion',
            'tipo_intervencion',
            'cantidad_hombres',
            'cantidad_mujeres',
            'compartir_informacion',
            'departamento_id',
            'ciudad_id',
            'perfil_participante_id',
            'perfil_participante',
            'sede_id',
            'fecha_intervencion',
            'inicio_intervencion',
            'fin_intervencion',
            'pauso_intervencion',
            'total_intervencion',
            'protocolo_sanamente_id',
            'primer_auxilio_psicologico_id',
            'apoyo_psicosocial_id',
            'referencia_intervencion_id',
            'discapacidad',
            'discapacidad_id',
            'participar_proceso_evaluacion',
            'comentario',
            'comentario_apoyo_psicosocial',
            'user_id',
            'tipo_otra_intervencion_id',
            'pauso_protocolo',
            'pauso_protocolo_id',
            'pauso_protocolo_otros',
            'persona_referida',
            'consentimiento',
            'protocolo_comentario',
            'tipo_psicoeducacion_id',
            'estrategia_id',
            'psicologicos_comentario',
            'psicologicos_consentimiento',
            'psicosociales_comentario',
            'razon_intervencion_id',
            'razon_otro',
            'proceso_id',
            'proceso_otro',
            'referencia',
            'referencias_comentario',
            'conceptualizacion_problema',
        ]);
    }
}
