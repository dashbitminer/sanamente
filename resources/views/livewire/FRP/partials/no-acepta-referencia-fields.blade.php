<div class="mt-10 grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="$wire.form.iniciar_proceso_referencia == 0">
    <div class="sm:col-span-3">
        <x-ref-input-label class="sm:text-lg" for="form.origen_consentimiento_id">{{ __('Origen de la referencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.origen_consentimiento_id" wire:model='form.origen_consentimiento_id' id="form.origen_consentimiento_id"
                :options="$origen_consentimientos" selected="Seleccione un Origen de la referencia" @class([ 'h-12 sm:text-lg',
                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.origen_consentimiento_id')
                ]) />
            <x-input-error :messages="$errors->get('form.origen_consentimiento_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label class="sm:text-lg" for="form.sexo_persona_contacta">{{ __('Sexo de la persona que se contacta:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                <x-ref-input-label class="flex items-center gap-4 h-12 sm:text-lg" for="form.sexo_persona_contacta_1">
                    <x-forms.input-radio type="radio" wire:model="form.sexo_persona_contacta"
                        id="form.sexo_persona_contacta_1"
                        name="form.sexo_persona_contacta" type="radio" value="1" class="h-12 sm:text-lg" />Femenino
                </x-ref-input-label>
                <x-ref-input-label class="flex items-center gap-4 h-12 sm:text-lg" for="form.sexo_persona_contacta_2">
                    <x-forms.input-radio type="radio" wire:model="form.sexo_persona_contacta"
                        id="form.sexo_persona_contacta_2"
                        name="form.sexo_persona_contacta" type="radio" value="2" class="h-12 sm:text-lg" />Masculino
                </x-ref-input-label>
            </div>
            <x-input-error :messages="$errors->get('form.sexo_persona_contacta')" class="mt-2" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label class="sm:text-lg" for="form.fecha_recibe_referencia">{{ __('Fecha en que se recibe la referencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-text-input wire:model="form.fecha_recibe_referencia" 
                id="form.fecha_recibe_referencia" 
                name="form.fecha_recibe_referencia"
                type="date"
                @class([
                    'h-12 sm:text-lg', 
                    'block w-full mt-1',
                    'border-2 border-red-500' => $errors->has('form.fecha_recibe_referencia')
                ])
            />
            <x-input-error :messages="$errors->get('form.fecha_recibe_referencia')" class="mt-2" />
        </div>
    </div>

    <div class="sm:col-span-3">
        <x-ref-input-label class="sm:text-lg" for="form.razon_no_acepta_referencia_id">{{ __('Razón por la que no aceptó la referencia:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.razon_no_acepta_referencia_id" wire:model='form.razon_no_acepta_referencia_id' id="form.razon_no_acepta_referencia_id"
                :options="$razon_no_acepta_referencias" selected="Seleccione una Razon de No acepta la referencia" @class([ 'h-12 sm:text-lg',
                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.razon_no_acepta_referencia_id')
                ]) />
            <x-input-error :messages="$errors->get('form.razon_no_acepta_referencia_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>
</div>