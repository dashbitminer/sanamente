<div x-data="formReferenciaParticipantesFields" class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="$wire.form.iniciar_proceso_referencia == 1">   
    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.nombres">{{ __('Nombres') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-text-input wire:model.live="form.nombres" id="form.nombres" name="form.nombres"
                type="text"
                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                @class([ 'h-12 sm:text-lg',
                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ])
                />
            <x-input-error :messages="$errors->get('form.nombres')" class="mt-2" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.apellidos">{{ __('Apellidos') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-text-input wire:model.live="form.apellidos" id="form.apellidos" name="form.apellidos"
                type="text"
                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                @class([ 'h-12 sm:text-lg',
                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.apellidos'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ])
                />
            <x-input-error :messages="$errors->get('form.apellidos')" class="mt-2" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.fecha_nacimiento">{{ __('Fecha de nacimiento:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-text-input  wire:model.lazy="form.fecha_nacimiento" id="form.fecha_nacimiento" name="form.fecha_nacimiento"
                type="date"
                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                    'border-2 border-red-500' => $errors->has('form.fecha_nacimiento'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ])
                @change="getAge($event.target.value)"
            />
            <x-input-error :messages="$errors->get('form.fecha_nacimiento')" class="mt-2" />
        </div>
    </div>
    
    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.sexo">{{ __('Sexo:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="px-4 py-3">
            <div class="flex gap-6">
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.sexo_1">
                    <x-forms.input-radio type="radio" wire:model="form.sexo"
                        disabled="{{ $form->readonly ? 'disabled' : '' }}"
                        id="form.sexo_1"
                        name="form.sexo" type="radio" value="1" class="h-12 sm:text-lg" />Femenino
                </x-ref-input-label>
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.sexo_2">
                    <x-forms.input-radio type="radio" wire:model="form.sexo"
                        disabled="{{ $form->readonly ? 'disabled' : '' }}"
                        id="form.sexo_2"
                        name="form.sexo" type="radio" value="2" class="h-12 sm:text-lg" />Masculino
                </x-ref-input-label>
            </div>
            <x-input-error :messages="$errors->get('form.sexo')" class="mt-2" />
        </div>
    </div>
    @if(!$form->esMenorEdad)
        <div class="sm:col-span-3">
            <x-ref-input-label for="form.nacionalidad" :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg' ">{{ __('Nacionalidad:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="px-4 py-3">
                <div class="flex gap-6">
                    <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.nacionalidad_1">
                        <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            id="form.nacionalidad_1"
                            name="form.nacionalidad" type="radio" value="1" class="h-12 sm:text-lg" />Nacional
                    </x-ref-input-label>
                    <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.nacionalidad_2">
                        <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            id="form.nacionalidad_2"
                            name="form.nacionalidad" type="radio" value="2" class="h-12 sm:text-lg" />Extranjero
                    </x-ref-input-label>
                </div>
                <x-input-error :messages="$errors->get('form.nacionalidad')" class="mt-2" aria-live="assertive"/>
            </div>
        </div>

   
        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.documento_identidad">{{ __('Número Único de Identificación:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.documento_identidad" id="form.documento_identidad" name="form.documento_identidad"
                    type="text"
                    placeholder="{{ $form->duiplaceholder }}" 
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    x-mask="{{ $form->dniformat }}" 
                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                        'border-2 border-red-500' => $errors->has('form.documento_identidad'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
            </div>
        </div>
    

        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.telefono">{{ __('Número de teléfono:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.telefono" id="form.telefono" name="form.telefono"
                    type="tel"
                    placeholder="55555555" maxlength="{{ $form->telephone_length }}"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                        'border-2 border-red-500' => $errors->has('form.telefono'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.telefono')" class="mt-2" />

            </div>
        </div>

        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.telefono_familiar">{{ __('Número de teléfono de un familiar o persona de confianza:') }}
                
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.telefono_familiar" id="form.telefono_familiar" name="form.telefono_familiar"
                    type="tel"
                    placeholder="55555555" maxlength="{{ $form->telephone_length }}"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                        'border-2 border-red-500' => $errors->has('form.telefono_familiar'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.telefono_familiar')" class="mt-2" />
            </div>
        </div>

    @endif

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.departamento_id">{{ __('Departamento de residencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.departamento_id" wire:model.live='form.departamento_id' id="form.departamento_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                :options="$departamentos" selected="Seleccione un departamento" @class([ 'h-12 sm:text-lg',
                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.departamento_id'),
                'sm:text-sm' => !$form->esPublico,
                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
            ]) />

            <x-input-error :messages="$errors->get('form.departamento_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.ciudad_id">{{ __('Municipio de residencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.ciudad_id" wire:model='form.ciudad_id' id="form.ciudad_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                :options="$form->ciudades" selected="Seleccione un municipio" @class([ 'h-12 sm:text-lg',
                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ciudad_id'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ]) />
            <x-input-error :messages="$errors->get('form.ciudad_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    @if($form->esMenorEdad)
        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.nombre_persona_responsable">{{ __('Nombre de la persona adulta responsable:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.nombre_persona_responsable" id="form.nombre_persona_responsable" name="form.nombre_persona_responsable"
                    type="text"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    @class(['h-12 sm:text-lg', 'block w-full mt-1 border-dark-green',
                        'border-2 border-red-500' => $errors->has('form.nombre_persona_responsable'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.nombre_persona_responsable')" class="mt-2" />
            </div>
        </div>
    @endif

    @if($form->esMenorEdad)
        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" 
                for="form.documento_identidad_persona_responsable">
                {{ __('Número Único de Identificación de la persona adulta responsable:') }}
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.documento_identidad_persona_responsable" id="form.documento_identidad_persona_responsable" name="form.documento_identidad_persona_responsable"
                    type="text"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    placeholder="{{ $form->duiplaceholder }}" 
                    x-mask="{{ $form->dniformat }}"
                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                        'border-2 border-red-500' => $errors->has('form.documento_identidad_persona_responsable'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.documento_identidad_persona_responsable')" class="mt-2" />
            </div>
        </div>
    @endif

    @if($form->esMenorEdad)
        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.telefono_persona_responsable">{{ __('Número de teléfono de la persona adulta responsable: ') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.telefono_persona_responsable" id="form.telefono_persona_responsable" name="form.telefono_persona_responsable"
                    type="tel"
                    placeholder="55555555" maxlength="{{ $form->telephone_length }}"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                        'border-2 border-red-500' => $errors->has('form.telefono_persona_responsable'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.telefono_persona_responsable')" class="mt-2" />
            </div>
        </div>
        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.telefono_familiar">{{ __('Número de teléfono de un familiar o persona de confianza:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.telefono_familiar" id="form.telefono_familiar" name="form.telefono_familiar"
                    type="tel"
                    placeholder="55555555" maxlength="{{ $form->telephone_length }}"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                        'border-2 border-red-500' => $errors->has('form.telefono_familiar'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.telefono_familiar')" class="mt-2" />
            </div>
        </div>
    @endif

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.perfil_participante_id">{{ __('Perfil de participante:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.perfil_participante_id" wire:model='form.perfil_participante_id' id="form.perfil_participante_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                :options="$perfil_participante" selected="Seleccione un perfil" @class([ 'h-12 sm:text-lg',
                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_participante_id'),
                'sm:text-sm' => !$form->esPublico,
                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ]) />
            <x-input-error :messages="$errors->get('form.perfil_participante_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'">{{ __('Posee algun tipo de discapacidad:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="px-4 py-3">
            <div class="flex gap-6">
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.posee_discapacidad_1">
                    <x-forms.input-radio type="radio" wire:model="form.posee_discapacidad"
                        id="form.posee_discapacidad_1"
                        disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                        name="form.posee_discapacidad" type="radio" value="1" class="h-12 sm:text-lg" />Si
                </x-ref-input-label>
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.posee_discapacidad_0">
                    <x-forms.input-radio type="radio" wire:model="form.posee_discapacidad"
                        id="form.posee_discapacidad_0"
                        disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                        name="form.posee_discapacidad" type="radio" value="0" class="h-12 sm:text-lg" />No
                </x-ref-input-label>
            </div>
            <x-input-error :messages="$errors->get('form.posee_discapacidad')" class="mt-2" />
        </div>
    </div>

    <div class="sm:col-span-3" x-show="$wire.form.posee_discapacidad == 1">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.tipo_discapacidad_id">{{ __('Tipo de discapacidad:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.tipo_discapacidad_id" wire:model='form.tipo_discapacidad_id' id="form.tipo_discapacidad_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                :options="$discapacidades" selected="Seleccione una discapacidad" @class([ 'h-12 sm:text-lg',
                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.tipo_discapacidad_id'),
                'sm:text-sm' => !$form->esPublico,
                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
            ]) />
            <x-input-error :messages="$errors->get('form.tipo_discapacidad_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.otras_condiciones_id">{{ __('¿La persona tiene otra condición o responsabilidad particular a considerar?') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.otras_condiciones_id" wire:model='form.otras_condiciones_id' id="form.otras_condiciones_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                x-ref="otras_condiciones_id"
                x-on:change="otrasCondicionesDropdown"
                x-init="otrasCondicionesDropdown({ target: $refs.otras_condiciones_id })"
                :options="$otras_condiciones" selected="Seleccione otra condición" @class([ 'h-12 sm:text-lg',
                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.otras_condiciones_id'),
                'sm:text-sm' => !$form->esPublico,
                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ]) />
            <x-input-error :messages="$errors->get('form.otras_condiciones_id')" class="mt-2" aria-live="assertive" />
        </div>

        <div class="mt-2" x-show="otras_condiciones_otra">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.otras_condiciones_otro">{{ __('Especifique:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.otras_condiciones_otro" id="form.otras_condiciones_otro" name="form.otras_condiciones_otro"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    type="text"
                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                        'border-2 border-red-500' => $errors->has('form.otras_condiciones_otro'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                />
                <x-input-error :messages="$errors->get('form.otras_condiciones_otro')" class="mt-2" aria-live="assertive" />
            </div>
        </div>
    </div>
    <div class="sm:col-span-3">
        
    </div>
</div> 

@if($form->esPublico)
    <div class="mb-10 border-b border-dark-green/50 pb-12" x-show="$wire.form.iniciar_proceso_referencia == 1"></div>
@endif

@script
<script>
    Alpine.data('formReferenciaParticipantesFields', () => ({
        otras_condiciones_otra: false,
        otrasCondicionesDropdown(event){
            const selectedOption = event.target.options[event.target.selectedIndex];
            this.otras_condiciones_otra = selectedOption.text.includes("Otros");
        },
    }))
</script>
@endscript