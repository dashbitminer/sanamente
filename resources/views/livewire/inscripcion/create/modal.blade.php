<div
    @keydown.window.escape="$wire.openDrawer = false"
    x-cloak x-show="$wire.openDrawer" class="relative z-50"
    aria-labelledby="slide-over-title" x-ref="dialog" aria-modal="true">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0"></div>

    <div class="overflow-hidden fixed inset-0">
        <div class="overflow-hidden absolute inset-0">
            <div class="flex fixed inset-y-0 right-0 pl-10 max-w-full pointer-events-none sm:pl-16">

                <div x-show="$wire.openDrawer"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    class="w-screen max-w-2xl pointer-events-auto"
                    x-description="Slide-over panel, show/hide based on slide-over state."
                    @click.away="$wire.openDrawer = false">
                    <form class="flex flex-col h-full bg-white divide-y divide-gray-200 shadow-xl" wire:submit='save'>
                        <div class="overflow-y-auto flex-1 h-0">
                          <div class="px-4 py-6 bg-indigo-700 sm:px-6">
                            <div class="flex justify-between items-center">
                              <h2 class="text-base font-semibold text-white" id="slide-over-title">
                                @if($inscripcion)
                                    {{ $inscripcion->nombres.' '. $inscripcion->apellidos }}
                                @endif
                                </h2>
                              <div class="flex items-center ml-3 h-7">
                                <button type="button" class="relative text-indigo-200 bg-indigo-700 rounded-md hover:text-white focus:outline-none focus:ring-2 focus:ring-white" @click="$wire.openDrawer = false">
                                  <span class="absolute -inset-2.5"></span>
                                  <span class="sr-only">Close panel</span>
                                  <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                  </svg>
                                </button>
                              </div>
                            </div>
                            <div class="mt-1">
                              <p class="text-sm text-indigo-300">FICHA DE INSCRIPCIÓN</p>
                            </div>
                          </div>
                          <div class="flex flex-col flex-1 justify-between">
                            <div class="px-4 divide-y divide-gray-200 sm:px-6">
                                <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-3 mb-5 sm:grid-cols-6" >
                                    <div class="col-span-full">
                                        <h3>DATOS DE IDENTIFICACIÓN</h3>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm" for="form.nombres">
                                            {{ __('Escribe tus nombres completos:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model.blur="form.nombres" id="form.nombres" name="form.nombres"
                                                type="text" placeholder="Nombres"
                                                @class([ 'h-12 text-sm',
                                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres')
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.nombres')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm" for="form.apellidos">
                                            {{ __('Escribe tus apellidos completos:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model.blur="form.apellidos" id="form.apellidos" name="form.apellidos"
                                                type="text" placeholder="Apellidos"
                                                @class([ 'h-12 text-sm',
                                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.apellidos')
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.apellidos')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm">
                                            {{ __('Escribe tu fecha de nacimiento:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model.blur="form.fecha_nacimiento" id="form.fecha_nacimiento" name="form.fecha_nacimiento"
                                                type="date" max="{{ $form->fecha_nacimiento_max }}"
                                                @class(['h-12 text-sm', 'block w-full mt-1',
                                                'border-2 border-red-500' => $errors->has('form.fecha_nacimiento')
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.fecha_nacimiento')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm" for="form.sexo">
                                            {{ __('Selecciona tu sexo según registro nacional:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="px-4 py-3">
                                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                                <x-input-label class="flex gap-4 items-center text-sm" for="form.sexo_1">
                                                    <x-forms.input-radio type="radio" wire:model.live="form.sexo"
                                                        id="form.sexo_1"
                                                        name="form.sexo" type="radio" value="1" />Hombre
                                                </x-input-label>
                                                <x-input-label class="flex gap-4 items-center text-sm" for="form.sexo_2">
                                                    <x-forms.input-radio type="radio" wire:model.live="form.sexo"
                                                        id="form.sexo_2"
                                                        name="form.sexo" type="radio" value="2" />Mujer
                                                </x-input-label>
                                            </div>
                                            <x-input-error :messages="$errors->get('form.sexo')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm" for="form.documento_identidad">
                                            {{ $labels['dni'] }}

                                            @if ($this->isDNIRequired())
                                                <x-required-label />
                                            @endif
                                        </x-input-label>
                                        <div class="mt-2">
                                            @if ($form->dni_mask)
                                                <x-text-input wire:model.blur="form.documento_identidad"
                                                    id="form.documento_identidad"
                                                    name="form.documento_identidad"
                                                    type="text"
                                                    placeholder="{{ $form->dni_placeholder }}"
                                                    x-mask="{{ $form->dni_mask }}"
                                                    @class(['h-12 text-sm', 'block w-full mt-1',
                                                    'border-2 border-red-500' => $errors->has('form.documento_identidad')
                                                    ]) />
                                            @else
                                                <x-text-input wire:model="form.documento_identidad"
                                                    id="form.documento_identidad"
                                                    name="form.documento_identidad"
                                                    type="text"
                                                    @class(['h-12 text-sm', 'block w-full mt-1',
                                                    'border-2 border-red-500' => $errors->has('form.documento_identidad')
                                                    ]) />
                                            @endif
                                            <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" x-cloak x-show="$wire.form.hasPerfilIdentificas == true">
                                        <x-input-label class="text-sm" for="form.perfil_institucional_id">
                                            {{ __('Selecciona tu tipo de personal institucional:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select name="form.perfil_institucional_id" wire:model.live='form.perfil_institucional_id' id="form.perfil_institucional_id"
                                                :options="$perfilInstitucionales" selected="Selecciona una opción" @class([ 'h-12 text-sm',
                                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_institucional_id')
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.perfil_institucional_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    @if ($form->institucionalEducacionSelect)
                                        <div class="sm:col-span-3">
                                            <x-input-label class="text-sm" for="form.perfil_institucional_educacion_id">
                                                {{ __('Selecciona tu perfil:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-forms.single-select name="form.perfil_institucional_educacion_id" wire:model.live='form.perfil_institucional_educacion_id' id="form.perfil_institucional_educacion_id"
                                                    :options="$form->institucionalEducacionSelect" selected="Selecciona una opción" @class([ 'h-12 text-sm',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_institucional_educacion_id')
                                                    ]) />
                                                <x-input-error :messages="$errors->get('form.perfil_institucional_educacion_id')" class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    @endif

                                    @if ($form->institucionalPoliciaSelect)
                                        <div class="sm:col-span-3">
                                            <x-input-label class="text-sm" for="form.perfil_institucional_policia_id">
                                                {{ __('Selecciona tu perfil:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-forms.single-select name="form.perfil_institucional_policia_id" wire:model.live='form.perfil_institucional_policia_id' id="form.perfil_institucional_policia_id"
                                                    :options="$form->institucionalPoliciaSelect" selected="Selecciona una opción" @class([ 'h-12 text-sm',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_institucional_policia_id')
                                                    ]) />
                                                <x-input-error :messages="$errors->get('form.perfil_institucional_policia_id')" class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    @endif

                                    @if ($form->rangosSelect)
                                        <div class="sm:col-span-3">
                                            <x-input-label class="text-sm" for="form.perfil_rango_id">
                                                {{ __('Selecciona tu rango/categoría:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-forms.single-select name="form.perfil_rango_id" wire:model.live='form.perfil_rango_id' id="form.perfil_rango_id"
                                                    :options="$form->rangosSelect" selected="Selecciona una opción" @class([ 'h-12 text-sm',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_rango_id')
                                                    ]) />
                                                <x-input-error :messages="$errors->get('form.perfil_rango_id')" class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    @endif

                                    @if ($form->rangoOrganizacionesSelect)
                                        <div class="sm:col-span-3">
                                            <x-input-label class="text-sm" for="form.perfil_rango_organizacion_id">
                                                {{ __('Selecciona tu perfil:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-forms.single-select name="form.perfil_rango_organizacion_id" wire:model.live='form.perfil_rango_organizacion_id' id="form.perfil_rango_organizacion_id"
                                                    :options="$form->rangoOrganizacionesSelect" selected="Selecciona una opción" @class([ 'h-12 text-sm',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_rango_organizacion_id')
                                                    ]) />
                                                <x-input-error :messages="$errors->get('form.perfil_rango_organizacion_id')" class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    @endif

                                    @if ($form->rangoSaludSelect)
                                        <div class="sm:col-span-3">
                                            <x-input-label class="text-sm" for="form.perfil_rango_salud_id">
                                                {{ __('Selecciona tu perfil:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-forms.single-select name="form.perfil_rango_salud_id" wire:model.live='form.perfil_rango_salud_id' id="form.perfil_rango_salud_id"
                                                    :options="$form->rangoSaludSelect" selected="Selecciona una opción" @class([ 'h-12 text-sm',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_rango_salud_id')
                                                    ]) />
                                                <x-input-error :messages="$errors->get('form.perfil_rango_salud_id')" class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    @endif

                                    @if ($form->personalSaludSelect)
                                        <div class="sm:col-span-3">
                                            <x-input-label class="text-sm" for="form.perfil_personal_salud_id">
                                                {{ __('Selecciona tu perfil de personal de salud:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-forms.single-select name="form.perfil_personal_salud_id" wire:model.live='form.perfil_personal_salud_id' id="form.perfil_personal_salud_id"
                                                    :options="$form->personalSaludSelect" selected="Selecciona una opción" @class([ 'h-12 text-sm',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_personal_salud_id')
                                                    ]) />
                                                <x-input-error :messages="$errors->get('form.perfil_personal_salud_id')" class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="grid grid-cols-1 gap-x-6 gap-y-8 pt-5 pb-8 sm:grid-cols-6" >
                                    <div class="col-span-full">
                                        <h3>DATOS DE SEDE</h3>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm" for="form.pertenece_departamento_id">
                                            {{ $labels['departamento_escuela'] }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <flux:select variant="listbox" searchable placeholder="Selecciona una opción"
                                            name="form.pertenece_departamento_id" wire:model.live='form.pertenece_departamento_id' id="form.pertenece_departamento_id"
                                            @class(['flux-custom-select', 'border-2 border-red-500' => $errors->has('form.pertenece_departamento_id')])>
                                                <x-slot name="search">
                                                    <flux:select.search class="px-4" placeholder="Buscar..." />
                                                </x-slot>

                                                @foreach ($form->perteneceDepartamentos as $key => $value)
                                                    <flux:option value="{{ $key }}">{{ $value }}</flux:option>
                                                @endforeach
                                            </flux:select>
                                            <x-input-error :messages="$errors->get('form.pertenece_departamento_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm" for="form.pertenece_ciudad_id">
                                            {{ $labels['minicipio_escuela'] }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <flux:select variant="listbox" searchable placeholder="Selecciona una opción"
                                            name="form.pertenece_ciudad_id" wire:model.live='form.pertenece_ciudad_id' id="form.pertenece_ciudad_id"
                                            @class(['flux-custom-select', 'border-2 border-red-500' => $errors->has('form.pertenece_ciudad_id')])>
                                                <x-slot name="search">
                                                    <flux:select.search class="px-4" placeholder="Buscar..." />
                                                </x-slot>

                                                @foreach ($form->perteneceCiudades as $key => $value)
                                                    <flux:option value="{{ $key }}">{{ $value }}</flux:option>
                                                @endforeach
                                            </flux:select>
                                            <x-input-error :messages="$errors->get('form.pertenece_ciudad_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm" for="form.pertenece_sede_id">
                                            {{ __('Selecciona la sede/escuela a la que pertenece') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <flux:select variant="listbox" searchable placeholder="Selecciona una opción"
                                            name="form.pertenece_sede_id" wire:model.live='form.pertenece_sede_id' id="form.pertenece_sede_id"
                                            @class(['flux-custom-select', 'border-2 border-red-500' => $errors->has('form.pertenece_sede_id')])>
                                                <x-slot name="search">
                                                    <flux:select.search class="px-4" placeholder="Buscar..." />
                                                </x-slot>

                                                @foreach ($form->perteneceSede as $key => $value)
                                                    <flux:option value="{{ $key }}">{{ $value }}</flux:option>
                                                @endforeach
                                            </flux:select>
                                            <x-input-error :messages="$errors->get('form.pertenece_sede_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 pb-6">
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="flex justify-end px-4 py-4 shrink-0">
                            <button type="button" class="px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-md ring-1 ring-inset ring-gray-300 shadow-sm hover:bg-gray-50"
                            @click="$wire.openDrawer = false">Cancelar</button>
                            <button type="submit"
                            x-show="$wire.form.fecha_nacimiento_validacion == true"
                            class="inline-flex justify-center px-3 py-2 ml-4 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Success Indicator... -->
     <x-notifications.success-text-notification message="Successfully saved!" />

     <!-- Error Indicator... -->
     <x-notifications.error-text-notification message="Han habido errores en el formulario" />

     <!-- Success Alert... -->
     <x-notifications.alert-success-notification>
         <p class="text-sm font-medium text-gray-900">¡Guardado exitosamente!</p>
         <p class="mt-1 text-sm text-gray-500">El registro fue guardado exitosamente y los cambios aparecerán en
             la ficha de registro.</p>
     </x-notifications.alert-success-notification>

     <!-- Error Alert... -->
     <x-notifications.alert-error-notification>
         <p class="text-sm font-medium text-red-900">¡Errores en el formulario!</p>
         <p class="mt-1 text-sm text-gray-500">Han habido problemas para guardar los cambios, corrija cualquier
             error en el formulario e intente nuevamente.</p>
     </x-notifications.alert-error-notification>
</div>

@script
<script>
    document.addEventListener('livewire:navigated', function () {
        Livewire.on('load-ciudades', () => {
            if ($wire.form.pertenece_ciudad_id) {
                const pertenece_ciudad_id = document.getElementById('form.pertenece_ciudad_id');

                if (pertenece_ciudad_id) {
                    setTimeout(() => pertenece_ciudad_id.value = $wire.form.pertenece_ciudad_id.toString(), 200);
                }
            }
        });

        Livewire.on('load-sedes', () => {
            if ($wire.form.pertenece_sede_id) {
                const pertenece_sede_id = document.getElementById('form.pertenece_sede_id');

                if (pertenece_sede_id) {
                    setTimeout(() => pertenece_sede_id.value = $wire.form.pertenece_sede_id.toString(), 200);
                }
            }
        });

        Livewire.on('load-perfil-institucional', () => {
            if ($wire.form.perfil_institucional_id) {
                const perfil_institucional_id = document.getElementById('form.perfil_institucional_id');

                if (perfil_institucional_id) {
                    setTimeout(() => perfil_institucional_id.value = $wire.form.perfil_institucional_id.toString(), 200);
                }
            }
        });
    });
</script>
@endscript
