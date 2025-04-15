<div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" >   
    <div class="sm:col-span-3">
        <x-ref-input-label class="sm:text-lg" for="form.seguimiento">{{ __(' Fecha de seguimiento:') }}
        </x-ref-input-label>
        <div class="mt-2">
            <span x-data="{ date: new Date(), time: '' }" x-init="
                const updateTime = () => {
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    time = `${hours}:${minutes}:${seconds}`;
                }
                updateTime();
                setInterval(updateTime, 1000);">
                    <span x-text="date.toLocaleDateString('en-GB')"></span>
                    <span x-text="time"></span>
            </span>
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label class="sm:text-lg" for="form.ha_recibido_servicio">{{ __('¿La persona ha recibido el servicio al cual fue referida?') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="px-4 py-3">
            <div class="flex gap-6">
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.ha_recibido_servicio_1">
                    <x-forms.input-radio type="radio" wire:model="form.ha_recibido_servicio"
                        id="form.sexo_1"
                        name="form.ha_recibido_servicio" type="radio" value="1" class="h-12 sm:text-lg" />Si
                </x-ref-input-label>
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.ha_recibido_servicio_2">
                    <x-forms.input-radio type="radio" wire:model="form.ha_recibido_servicio"
                        id="form.sexo_2"
                        name="form.ha_recibido_servicio" type="radio" value="2" class="h-12 sm:text-lg" />No
                </x-ref-input-label>
            </div>
            <x-input-error :messages="$errors->get('form.ha_recibido_servicio')" class="mt-2" />
        </div>
    </div>

    <div class="sm:col-span-full" x-show="$wire.form.ha_recibido_servicio == 1">
        <x-ref-input-label class="sm:text-lg" for="form.seguimiento_descripcion">{{ __('Breve descripción del seguimiento:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <textarea
            class="block w-full rounded-md py-1.5 border-gray-300 focus:border-indigo-500 text-dark-gray shadow-sm mt-2"
            name="form.seguimiento_descripcion" id="form.seguimiento_descripcion"  wire:model='form.seguimiento_descripcion' rows="5"></textarea>
            <x-input-error :messages="$errors->get('form.seguimiento_descripcion')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    <div class="sm:col-span-3" x-show="$wire.form.ha_recibido_servicio == 2">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.pais_seguimiento_detalle_id">{{ __('¿Por qué?') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.pais_seguimiento_detalle_id" wire:model='form.pais_seguimiento_detalle_id' id="form.pais_seguimiento_detalle_id"
                :options="$seguimiento_detalles" selected="Seleccione una opcion" @class([ 'h-12 sm:text-lg',
                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.pais_seguimiento_detalle_id'),
                'sm:text-sm' => !$form->esPublico,
            ]) />
            <x-input-error :messages="$errors->get('form.pais_seguimiento_detalle_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    <div class="sm:col-span-3" x-show="$wire.form.ha_recibido_servicio == 2">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.pais_seguimiento_paso_id">{{ __(' Indique cuál es el siguiente paso:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.pais_seguimiento_paso_id" wire:model='form.pais_seguimiento_paso_id' id="form.pais_seguimiento_paso_id"

                :options="$seguimiento_pasos" selected="Seleccione una opcion" @class([ 'h-12 sm:text-lg',
                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.pais_seguimiento_paso_id'),
                    'sm:text-sm' => !$form->esPublico,
                ]) />
            <x-input-error :messages="$errors->get('form.pais_seguimiento_paso_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    <div class="sm:col-span-full">
        <x-ref-input-label class="sm:text-lg" for="form.solicita_otra_referencia">{{ __('¿La persona solicita otra referencia?') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="px-4 py-3">
            <div class="flex gap-6">
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.solicita_otra_referencia_1">
                    <x-forms.input-radio type="radio" wire:model="form.solicita_otra_referencia"
                        id="form.sexo_1"
                        name="form.solicita_otra_referencia" type="radio" value="1" class="h-12 sm:text-lg" />Si
                </x-ref-input-label>
                <x-ref-input-label class="flex items-center h-12 gap-2 {{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'}}" for="form.solicita_otra_referencia_2">
                    <x-forms.input-radio type="radio" wire:model="form.solicita_otra_referencia"
                        id="form.sexo_2"
                        name="form.solicita_otra_referencia" type="radio" value="2" class="h-12 sm:text-lg" />No
                </x-ref-input-label>
            </div>
            <div x-show="$wire.form.solicita_otra_referencia == 1">
                <a href="{{ route('referencia.nueva_referencia', ['pais' => $pais, 'edad' => $edad, 'referenciaParticipante' => $referenciaParticipante->id ]) }}" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                      </svg>                      
                    Nueva Referencia
                </a>
            </div>
            <x-input-error :messages="$errors->get('form.solicita_otra_referencia')" class="mt-2" />
        </div>
    </div>

    <div class="sm:col-span-full" x-show="$wire.form.solicita_otra_referencia == 2">
        <x-ref-input-label class="sm:text-lg" for="form.seguimiento_comentario">{{ __('Dejar un breve comentario del porque se cierra el caso:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <textarea
            class="block w-full rounded-md py-1.5 border-gray-300 focus:border-indigo-500 text-dark-gray shadow-sm mt-2"
            name="form.seguimiento_comentario" id="form.seguimiento_comentario"  wire:model='form.seguimiento_comentario' rows="5"></textarea>
            <x-input-error :messages="$errors->get('form.seguimiento_comentario')" class="mt-2" aria-live="assertive" />
        </div>
    </div>
</div> 