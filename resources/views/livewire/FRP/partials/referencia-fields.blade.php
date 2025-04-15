<div x-data="formReferenciaFields" class="mt-10 grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="$wire.form.iniciar_proceso_referencia == 1"> 
                    
    <div class="sm:col-span-3 ">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.fecha_registro">{{ __('Fecha de registro de la referencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-text-input wire:model.lazy="form.fecha_registro" id="form.fecha_registro" name="form.fecha_registro"
                type="date"
                max="{{ date('Y-m-d') }}"
                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                    'border-2 border-red-500' => $errors->has('form.fecha_registro'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ])
                />
            <x-input-error :messages="$errors->get('form.fecha_registro')" class="mt-2" />
        </div>
    </div>
    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.accion_inmediata_id">{{ __('¿Qué acción realizó de forma inmediata previa a la referencia?') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.multiple-choice
                model="form.accion_inmediata_id"
                placeholderValue="Selecciona una opción"                             
                :options="$accion_inmediatas"
                x-on:change="accionInmediataDropdown"
                init="accionInmediataDropdown"
                :selected="$form->accion_inmediata_id"
            />
            <x-input-error :messages="$errors->get('form.accion_inmediata_id')" class="mt-2" aria-live="assertive" />
        </div>

        <div class="mt-2" x-show="accion_inmediata_otra">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.accion_inmediata_otro">{{ __('Especifique:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <textarea
                {{ $form->readonly ? 'disabled' : '' }} 
                    class="block w-full rounded-md py-1.5 border-gray-300 focus:border-indigo-500 text-dark-gray shadow-sm mt-2"
                    name="form.accion_inmediata_otro" id="form.accion_inmediata_otro"  
                    wire:model='form.accion_inmediata_otro' rows="5"></textarea>
                <x-input-error :messages="$errors->get('form.accion_inmediata_otro')" class="mt-2" aria-live="assertive" />
            </div>
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.motivo_referencia_id">{{ __('Motivo de la referencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.multiple-choice
                model="form.motivo_referencia_id"
                placeholderValue="Selecciona una opción"                             
                :options="$motivo_referencias"
                x-on:change="motivoReferenciaDropdown"
                init="motivoReferenciaDropdown"
                :selected="$form->motivo_referencia_id"
            />

            <x-input-error :messages="$errors->get('form.motivo_referencia_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>
    <div class="sm:col-span-3">
        <div x-show="motivo_violencia_fisica">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.tipo_violencia_id">{{ __('Tipo de violencia:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-forms.multiple-choice
                    model="form.tipo_violencia_id"
                    placeholderValue="Selecciona una opción"                             
                    :options="$tipo_violencias"
                    :selected="$form->tipo_violencia_id"
                />
                <x-input-error :messages="$errors->get('form.tipo_violencia_id')" class="mt-2" aria-live="assertive" />
            </div>
        </div>

        <div x-show="motivo_otra">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.motivo_referencia_otro">{{ __('Especifique:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.motivo_referencia_otro" id="form.motivo_referencia_otro" name="form.motivo_referencia_otro"
                    type="text"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                    @class([ 'h-12 sm:text-lg',
                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.motivo_referencia_otro'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                />
                <x-input-error :messages="$errors->get('form.motivo_referencia_otro')" class="mt-2" />
            </div>
        </div>
        
    </div>

    <div class="sm:col-span-full">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.comentarios">{{ __('Comentarios:') }}
        </x-ref-input-label>
        <div class="mt-2">
            <textarea
            {{ $form->readonly ? 'disabled' : '' }}
            class="block w-full rounded-md py-1.5 border-gray-300 focus:border-indigo-500 text-dark-gray shadow-sm mt-2"
            name="form.comentarios" id="form.comentarios"  wire:model='form.comentarios' rows="5"></textarea>
            <x-input-error :messages="$errors->get('form.comentarios')" class="mt-2" aria-live="assertive" />
        </div>
    </div>
    @if ($form->esMenorEdad)
        <div class="sm:col-span-3">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'">{{ __('¿Se activaron protocolos de protección nacionales o institucionales (de sede)?') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="px-4 py-3">
                <div class="flex gap-6">
                    <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.activacion_protocolos_1">
                        <x-forms.input-radio type="radio" wire:model="form.activacion_protocolos"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            id="form.activacion_protocolos_1"
                            name="form.activacion_protocolos" type="radio" value="1" class="h-12 sm:text-lg" />Si
                    </x-ref-input-label>
                    <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.activacion_protocolos_0">
                        <x-forms.input-radio type="radio" wire:model="form.activacion_protocolos"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            id="form.activacion_protocolos_0"
                            name="form.activacion_protocolos" type="radio" value="0" class="h-12 sm:text-lg" />No
                    </x-ref-input-label>
                </div>
                <x-input-error :messages="$errors->get('form.activacion_protocolos')" class="mt-2" />
            </div>
        </div>

    
        <div class="sm:col-span-3" x-show="$wire.form.activacion_protocolos == 1">
            <div class="mt-2" x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <x-ref-input-label for="documento_protocolos"
                    class="sm:text-lg block py-3 mt-2 mb-2">{{ __('Anexar documentos que respalden la activación de protocolos:') }}
                    <x-required-label />
                </x-ref-input-label>

                <!-- File Input -->
                <input type="file" wire:model.live="form.documento_protocolos" 
                
                @class([
                    "w-full text-sm font-semibold text-dark-gray bg-white border rounded
                    cursor-pointer file:cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4
                    file:bg-gray-100 file:hover:bg-gray-200 file:text-dark-gray",
                    'sm:text-sm' => !$form->esPublico,
                            'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ])
                />
                <p class="mt-2 text-xs text-dark-gray">Tipos de archivos permitidos: PNG, JPG,
                    GIF, DOCX y PDF.</p>

                <!-- Progress Bar -->
                <div x-show="uploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>

                <x-input-error :messages="$errors->get('form.documento_protocolos')"
                    class="mt-2" aria-live="assertive" />
            </div>
        </div>
    @endif

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.tipo_servicio_id">{{ __('Tipo de servicio al que se le refiere:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2 {{!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}">
            <x-forms.multiple-choice
                model="form.tipo_servicio_id"
                placeholderValue="Selecciona una opción"                            
                :options="$tipo_servicios"
                x-on:change="tipoServicioDropdown"
                init="tipoServicioDropdown"
               :selected="$form->tipo_servicio_id"
            />
            <x-input-error :messages="$errors->get('form.tipo_servicio_id')" class="mt-2" aria-live="assertive" />
        </div>

        <div x-show="tipo_servicio_salud_mental" >
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.tipo_servicio_salud_mental_id">{{ __('Tipo de servicio de salud mental:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-forms.single-select name="form.tipo_servicio_salud_mental_id" wire:model='form.tipo_servicio_salud_mental_id' id="form.tipo_servicio_salud_mental_id"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}"
                    :options="$tipo_servicios_salud_mental" selected="Seleccione un tipo de servicio de salud mental" @class([ 'h-12 sm:text-lg',
                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.tipo_servicio_salud_mental_id'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ]) />
                <x-input-error :messages="$errors->get('form.tipo_servicio_salud_mental_id')" class="mt-2" aria-live="assertive" />
            </div>
        </div>

        <div class="mt-2" x-show="tipo_servicio_otra">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.tipo_servicio_otra">{{ __('Especifique otro tipo de servicio:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.tipo_servicio_otra" id="form.tipo_servicio_otra" name="form.tipo_servicio_otra"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}"
                    type="text"
                    @class([ 'h-12 sm:text-lg',
                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.tipo_servicio_otra'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                />
                <x-input-error :messages="$errors->get('form.tipo_servicio_otra')" class="mt-2" />
            </div>
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.institucion_refiere_id">{{ __('Institución a la que se refiere:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.institucion_refiere_id" wire:model='form.institucion_refiere_id' id="form.institucion_refiere_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                x-ref="institucion_refiere_id"
                x-on:change="institucionRefiereDropdown"
                x-init="institucionRefiereDropdown({ target: $refs.institucion_refiere_id })"
                :options="$instituciones" selected="Seleccione una Institución" @class([ 'h-12 sm:text-lg',
                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.institucion_refiere_id'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ]) />
            <x-input-error :messages="$errors->get('form.institucion_refiere_id')" class="mt-2" aria-live="assertive" />
        </div>

        <div class="mt-2" x-show="institucion_otro">
            <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.nombre_otra_institucion">{{ __('Nombre de la institución a la que se refiere que no es parte de la red:') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="mt-2">
                <x-text-input wire:model="form.nombre_otra_institucion" id="form.nombre_otra_institucion" name="form.nombre_otra_institucion"
                    disabled="{{ $form->readonly ? 'disabled' : '' }}"
                    type="text"
                    @class([ 'h-12 sm:text-lg',
                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombre_otra_institucion'),
                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.institucion_refiere_id'),
                        'sm:text-sm' => !$form->esPublico,
                        'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                    ])
                    />
                <x-input-error :messages="$errors->get('form.nombre_otra_institucion')" class="mt-2" />
            </div>
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.parametro_urgencia_id">{{ __('Parámetro de la urgencia de la referencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.parametro_urgencia_id" wire:model='form.parametro_urgencia_id' id="form.parametro_urgencia_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                :options="$parametros_urgencias" selected="Seleccione un Parámetro" @class([ 'h-12 sm:text-lg',
                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.parametro_urgencia_id'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ]) />
            <x-input-error :messages="$errors->get('form.parametro_urgencia_id')" class="mt-2" aria-live="assertive" />
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
    Alpine.data('formReferenciaFields', () => ({
        institucion_otro: false,
        tipo_servicio_otra: false,
        tipo_servicio_salud_mental: false,
        motivo_otra: false,
        motivo_violencia_fisica: false,
        accion_inmediata_otra: false,

        institucionRefiereDropdown(event){
            const selectedOption = event.target.options[event.target.selectedIndex];
            this.institucion_otro = selectedOption.text.includes("Otra");
        },
        tipoServicioDropdown(event){
            const selectedOptions = Array.from(event.target.selectedOptions);
            this.tipo_servicio_otra = selectedOptions.some(option => option.text.includes('Otros (especifica):'));
            this.tipo_servicio_salud_mental = selectedOptions.some(option => option.text.includes('Servicios de salud mental'));
        },
        motivoReferenciaDropdown(event){
            const selectedOptions = Array.from(event.target.selectedOptions);
            this.motivo_otra = selectedOptions.some(option => option.text.includes('Otros'));
            this.motivo_violencia_fisica = selectedOptions.some(option => option.text.includes('Sobreviviente de violencia'));

        },
        accionInmediataDropdown(event){
            const selectedOptions = Array.from(event.target.selectedOptions);
            this.accion_inmediata_otra = selectedOptions.some(option => option.text.includes('Otras'));
            
        },
    }))
</script>
@endscript