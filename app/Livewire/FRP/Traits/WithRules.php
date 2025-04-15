<?php

namespace App\Livewire\FRP\Traits;

use Illuminate\Validation\Rule;
use App\Rules\DocumentoIdentidadRule;
use Carbon\Carbon;
use Illuminate\Validation\Rules\File;

trait WithRules
{
    protected function rules(): array
    {
        return $this->rulesReferenciaParticipante() + $this->rulesReferencia();
    }

    protected function rulesIfNoStartReferenceProcess (): array
    {
        return [
            'origen_consentimiento_id' => ['required'],
            'sexo_persona_contacta' => ['required'],
            'fecha_recibe_referencia' => ['required', 'date'],
            'razon_no_acepta_referencia_id' => ['required']
        ];
    }

    protected function rulesReferenciaParticipante(): array
    {
        return [
            'nombres' => ['required'],
            'apellidos' => ['required'],
            'fecha_nacimiento' => [
                'required',
                'date',
                function($attribute, $value, $fail){
                    $this->edad = Carbon::parse($value)->age;

                    if($this->esMenorEdad && $this->edad >=18){
                        return $fail('Solo puedes registrar participantes menores de edad.');
                    }
                    if(!$this->esMenorEdad && $this->edad < 18){
                        return $fail('Solo puedes registrar participantes mayores de edad.');
                    }
                }
            ],
            'sexo' => ['required'],
            'documento_identidad' => array_filter([
                Rule::requiredIf($this->isMayorEdad()), 
                $this->isMayorEdad() ? new DocumentoIdentidadRule($this->pais, $this->nacionalidad) : null, 
            ]),
            'telefono' => [
                Rule::requiredIf($this->isMayorEdad() )
            ],
            //'telefono_familiar' => ['required'],
            'nombre_persona_responsable' => [
                Rule::requiredIf($this->isMenorEdad() )
            ],
            /*'documento_identidad_persona_responsable' => array_filter([
                Rule::requiredIf($this->isMenorEdad()), 
                $this->isMenorEdad() ? new DocumentoIdentidadRule($this->pais, $this->nacionalidad) : null, 
            ]),*/
            'telefono_persona_responsable' => [
                Rule::requiredIf($this->isMenorEdad() )
            ],
            'ciudad_id'=> ['required'],
            'departamento_id' => ['required'],
            'perfil_participante_id' => ['required'],
            'posee_discapacidad' => ['required'],
            'tipo_discapacidad_id' => [
                Rule::requiredIf(function () {
                    return $this->posee_discapacidad == 1;
                })
            ],
            'otras_condiciones_id' => ['required'],
            'otras_condiciones_otro' => [
                Rule::requiredIf(function () {
                    return $this->pais->otraCondicion()
                            ->where('pais_otra_condiciones.id', $this->otras_condiciones_id)
                            ->where('otra_condiciones.slug', 'otros')
                            ->count();
                })
            ],
        ];
    }

    protected function rulesReferencia():array
    {
        return [
            'fecha_registro' => ['required', 'date', function ($attribute, $value, $fail) {
                if (Carbon::parse($value)->greaterThan(Carbon::today())) {
                    $fail('La Fecha de registro no puede ser posterior a hoy.');
                }
            }],
            'accion_inmediata_id' => ['required'],
            'accion_inmediata_otro' => [
                Rule::requiredIf(function () {
                    return $this->pais->accionInmediata()
                        ->whereIn('pais_accion_inmediatas.id', $this->accion_inmediata_id)
                        ->where('accion_inmediatas.slug', 'otras')
                        ->count();
                })
            ],
            'motivo_referencia_id' => ['required'],
            'motivo_referencia_otro' => [
                Rule::requiredIf(function () {
                    return $this->pais->motivoReferencia()
                            ->whereIn('pais_motivo_referencias.id', $this->motivo_referencia_id)
                            ->where('motivo_referencias.slug', 'otros-2')
                            ->count();
                })
            ],
            'tipo_violencia_id' => [
                Rule::requiredIf(function () {
                    return $this->pais->motivoReferencia()
                            ->whereIn('pais_motivo_referencias.id', $this->motivo_referencia_id)
                            ->where('motivo_referencias.slug', 'sobreviviente-de-violencia')
                            ->count();
                })
            ],
            'activacion_protocolos' => [
                Rule::requiredIf($this->isMenorEdad() )
            ],
            'documento_protocolos' => [
                Rule::when($this->isMenorEdad() && $this->activacion_protocolos == 1, [
                    'required',
                    File::types(['pdf', 'docx', 'jpeg', 'png'])
                        ->min('1kb')
                        ->max('2mb'),
                ]),
            ],
            'tipo_servicio_id' => ['required'],
            'tipo_servicio_salud_mental_id' => [
                Rule::requiredIf(function () {
                    return $this->pais->tipoServicio()
                            ->whereIn('pais_tipo_servicios.id', $this->tipo_servicio_id)
                            ->where('tipo_servicios.slug', 'servicios-de-salud-mental')
                            ->count();
                })
            ],
            'tipo_servicio_otra' => [
                Rule::requiredIf(function () {
                    return $this->pais->tipoServicio()
                            ->whereIn('pais_tipo_servicios.id', $this->tipo_servicio_id)
                            ->where('tipo_servicios.slug', 'otros-especifica')
                            ->count();
                })
            ],
            'institucion_refiere_id' => ['required'],
            'nombre_otra_institucion' => [ /// preguntar por este campo 
                Rule::requiredIf(function () {
                    return $this->institucion_refiere_id == 16; 
                })
            ],
            'parametro_urgencia_id' => ['required'],
            'modalid_consentimiento_id' => ['required'],
            'documento_consentimientos' => [                
                Rule::when(
                    $this->pais->ModalidadConsentimiento()
                        ->where('pais_modalidad_consentimientos.id', $this->modalid_consentimiento_id)
                        ->where('modalidad_consentimientos.slug', 'registro-de-consentimiento-fisico')
                        ->count()
                    , [
                    'required',
                    File::types(['pdf', 'docx', 'jpeg', 'png'])
                        ->min('1kb')
                        ->max('2mb'),
                ]),
            ],
            'autorizacion_persona_adulta' => [
                Rule::requiredIf($this->isMenorEdad() )
            ],
            'acepta_referencia' => ['required'], /// checkbox acepta
            'autoriza_adulto' => [ /// checkbox autorizacion adulto
                Rule::requiredIf($this->isMenorEdad() )
            ]
        ];
    }

    public function messages()
    {
        return [
            'nombres.required' => 'El campo nombres es requerido.',
            'apellidos.required' => 'El campo apellidos es requerido.',
            'fecha_nacimiento.required' => 'El campo Fecha de Nacimiento es requerido.',
            'sexo.required' => 'El campo sexo es requerido',
            'documento_identidad.required' => 'El campo Documento de identidad es requerido.',
            'telefono.required' => 'El campo Número de teléfono es requerido',
            'telefono_familiar.required' => 'El campo Número de teléfono de un familiar o persona de confianza es requerido.',
            'nombre_persona_responsable.required' => 'El campo Nombre de la persona adulta responsable es requerido.',
            'documento_identidad_persona_responsable.required' => 'El campo Número Único de Identificación de la persona adulta responsable es requerido.',
            'telefono_persona_responsable.required' => 'El campo Número de teléfono de la persona adulta responsable es requerido.',
            'ciudad_id.required' => 'El campo Municipio de residencia es requerido.',
            'departamento_id.required' => 'El campo Departamento de residencia es requerido.',
            'perfil_participante_id.required' => 'El campo Perfil de participante es requerido.',
            'posee_discapacidad.required' => 'El campo Posee algun tipo de discapacidad es requerido',
            'tipo_discapacidad_id.required' => 'El campo Tipo de discapacidad es requerido.',
            'otras_condiciones_id.required' => 'El campo La persona tiene otra condición o responsabilidad particular a considerar es requerido',
            'otras_condiciones_otro.required' => 'El campo La persona tiene otra condición o responsabilidad particular a considera Especifique es requerido',
            'fecha_registro.required' => 'El campo Fecha de registro de la referencia es requerido',
            'accion_inmediata_id.required' => 'El campo Qué acción realizó de forma inmediata previa a la referencia es requerido',
            'accion_inmediata_otro.required' => 'El campo Qué acción realizó de forma inmediata previa a la referencia Especifique es requerido',
            'motivo_referencia_id.required' => 'El campo Motivo de la referencia es requerido.',
            'motivo_referencia_otro.required' => 'El campo Motivo de la referencia Especifique es requerido.',
            'tipo_violencia_id.required' => 'El campo Tipo de violencia es requerido.',
            'activacion_protocolos.required' => 'El campo Se activaron protocolos de protección nacionales o institucionales (de sede) es requerido.',
            'documento_protocolos.required' => 'El campo Anexar documentos que respalden la activación de protocolos es requerido.',
            'tipo_servicio_id.required' => 'El campo Tipo de servicio al que se le refiere es requerido.',
            'tipo_servicio_salud_mental_id.required' => 'El campo Tipo de servicio de salud mental es requerido.',
            'tipo_servicio_otra.requiered' => 'El campo Tipo de servicio Especifique es requerido.',
            'institucion_refiere_id.required' => 'El campo Institución a la que se refiere es requerido.',
            'nombre_otra_institucion.required' => 'El campo Nombre de la institución a la que se refiere que no es parte de la red es requerido.',
            'parametro_urgencia_id.required' => 'El campo Parámetro de la urgencia de la referencia es requerido.',
            'modalid_consentimiento_id.required' => 'El campo Modalidad de registro de consentimiento es requerido.',
            'autorizacion_persona_adulta.required' => 'El campo Se cuenta con autorización de la persona adulta responsable es requerido.',
            'acepta_referencia.required' => 'El campo La persona acepta de forma verbal la referencia es requerido.',
            'autoriza_adulto.required' => 'El campo Autorizacion de Adulto es requerido.', 
            'ha_recibido_servicio.required' => 'El campo La persona ha recibido el servicio al cual fue referida es requerido.',
            'seguimiento_descripcion.required' => 'El campo Breve descripción del seguimiento es requerido.',
            'pais_seguimiento_detalle_id.required' => 'El campo ¿Por qué? es requerido.',
            'pais_seguimiento_paso_id.required' => 'El campo Indique cuál es el siguiente paso es requerido.',
            'origen_consentimiento_id.required' => 'El campo Origen de la referencia es requerido.',
            'sexo_persona_contacta.required' => 'El campo Sexo de la persona que se contacta es requerido.',
            'fecha_recibe_referencia.required' => 'El campo Fecha en que se recibe la referencia es requerido.',
            'razon_no_acepta_referencia_id.required' => 'El campo Razón por la que no aceptó la referencia es requerido.'
        ];
    }

}