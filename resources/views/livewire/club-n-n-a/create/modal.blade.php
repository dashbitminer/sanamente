<div
    @keydown.window.escape="$wire.openDrawer = false"
    x-cloak x-show="$wire.openDrawer" class="relative z-50"
    aria-labelledby="slide-over-title" x-ref="dialog" aria-modal="true">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 pointer-events-none sm:pl-16">

                <div x-show="$wire.openDrawer"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    class="w-screen max-w-2xl pointer-events-auto "
                    x-description="Slide-over panel, show/hide based on slide-over state."
                    @click.away="$wire.openDrawer = false">
                    <form class="flex flex-col h-full bg-white divide-y divide-gray-200 shadow-xl" wire:submit='save'>
                        <div class="flex-1 h-0 overflow-y-auto">
                          <div class="px-4 py-6 bg-indigo-700 sm:px-6">
                            <div class="flex items-center justify-between">
                              <h2 class="text-base font-semibold text-white" id="slide-over-title">
                                @if($clubNNa)
                                    {{ $clubNNa->nombres.' '. $clubNNa->apellidos }}
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
                              <p class="text-sm text-indigo-300">FICHA DE INSCRIPCIÓN DE PARTICIPANTES NNA</p>
                            </div>
                          </div>
                          <div class="flex flex-col justify-between flex-1">
                            <div class="px-4 divide-y divide-gray-200 sm:px-6">
                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" >
                                    <div class="col-span-full">
                                        <h3>Datos Persona Responsable</h3>
                                    </div>
                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.nombres_responsable">{{ __('Nombres y Apellidos completos del adulto responsable:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model.live="form.nombres_responsable" id="form.nombres_responsable" name="form.nombres_responsable"
                                                type="text" placeholder="Nombres y Apellidos"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres_responsable'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ])
                                                />
                                            <x-input-error :messages="$errors->get('form.nombres_responsable')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.parentesco">{{ __('Parentesco') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select name="form.parentesco" wire:model='form.parentesco' id="form.parentesco"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :options="$parentescos"
                                                selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.parentesco'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.parentesco')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.telefono">{{ __('Número de teléfono:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model="form.telefono" id="form.telefono" name="form.telefono"
                                                type="tel"
                                                placeholder="55555555" maxlength="{{ $form->telephone_length }}"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                @class(['h-12 text-sm/6', 'block w-full mt-1',
                                                    'border-2 border-red-500' => $errors->has('form.telefono'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ])
                                                />
                                            <x-input-error :messages="$errors->get('form.telefono')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.documento_identidad">{{ $labels['dni'] }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model="form.documento_identidad" id="form.documento_identidad" name="form.documento_identidad"
                                                type="text"
                                                placeholder="{{ $form->duiplaceholder }}"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                x-mask="{{ $form->dniformat }}"
                                                @class(['h-12 text-sm/6', 'block w-full mt-1',
                                                    'border-2 border-red-500' => $errors->has('form.documento_identidad'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ])
                                                />
                                            <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6"
                                    x-show="$wire.form.deseo_participar == 1
                                    && $wire.form.uso_recoleccion_datos == 1">
                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.nacionalidad">{{ __('Selecciona tu nacionalidad:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="px-4 py-3">
                                            <div class="flex gap-6">
                                                <x-input-label class="flex items-center gap-2 text-sm/6">
                                                    <x-forms.input-radio type="radio" wire:model="form.nacionalidad"
                                                            id="form.nacionalidad_1"
                                                            name="form.nacionalidad" type="radio" value="1" />
                                                    {{ $labels['nacionalidad'] }}
                                                </x-input-label>
                                                <x-input-label class="flex items-center gap-2 text-sm/6">
                                                    <x-forms.input-radio type="radio" wire:model="form.nacionalidad"
                                                    id="form.nacionalidad_2"
                                                    name="form.nacionalidad" type="radio" value="2" />
                                                    Extranjero(a)
                                                </x-input-label>
                                            </div>
                                            <x-input-error :messages="$errors->get('form.nacionalidad')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.ha_participado_anteriormente">{{ __('¿Has participado en años anteriores en actividades de Glasswing?') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select name="form.ha_participado_anteriormente" wire:model='form.ha_participado_anteriormente' id="form.ha_participado_anteriormente"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :options="['Sí', 'No']" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ha_participado_anteriormente'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.ha_participado_anteriormente')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.nombres">{{ __('Nombres Completo') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model.live="form.nombres" id="form.nombres" name="form.nombres"
                                                type="text"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ])
                                                />
                                            <x-input-error :messages="$errors->get('form.nombres')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.apellidos">{{ __('Apellidos Completo') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input wire:model.live="form.apellidos" id="form.apellidos" name="form.apellidos"
                                                type="text"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.apellidos'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ])
                                                />
                                            <x-input-error :messages="$errors->get('form.apellidos')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.fecha_nacimiento">{{ __('Escribe tu fecha de nacimiento:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-text-input  wire:model.lazy="form.fecha_nacimiento" id="form.fecha_nacimiento" name="form.fecha_nacimiento"
                                                type="date"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                @class(['h-12 text-sm/6', 'block w-full mt-1',
                                                    'border-2 border-red-500' => $errors->has('form.fecha_nacimiento'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ])
                                            />
                                            <x-input-error :messages="$errors->get('form.fecha_nacimiento')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.sexo">{{ __('Selecciona tu sexo según registro nacional:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="px-4 py-3">
                                            <div class="flex gap-6">
                                                <x-input-label class="flex items-center gap-2 text-sm/6" for="form.sexo_1">
                                                    <x-forms.input-radio type="radio" wire:model="form.sexo"
                                                        disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                        id="form.sexo_1"
                                                        name="form.sexo" type="radio" value="1" class="h-12 text-sm/6" />Mujer
                                                </x-input-label>
                                                <x-input-label class="flex items-center h-12 gap-2 text-sm/6" for="form.sexo_2">
                                                    <x-forms.input-radio type="radio" wire:model="form.sexo"
                                                        disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                        id="form.sexo_2"
                                                        name="form.sexo" type="radio" value="2" class="h-12 text-sm/6" />Hombre
                                                </x-input-label>
                                            </div>
                                            <x-input-error :messages="$errors->get('form.sexo')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <x-input-label class="text-sm/6" for="form.encuentras_estudiando">{{ __('¿Te encuentras estudiando actualmente?') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="px-4 py-3">
                                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                                <x-input-label class="flex items-center h-12 gap-4 text-sm/6" for="form.encuentras_estudiando_1">
                                                    <x-forms.input-radio type="radio" wire:model="form.encuentras_estudiando"
                                                        id="form.encuentras_estudiando"
                                                        name="form.encuentras_estudiando" type="radio" value="1" />Sí
                                                </x-input-label>
                                                <x-input-label class="flex items-center h-12 gap-4 text-sm/6" for="form.encuentras_estudiando_0">
                                                    <x-forms.input-radio type="radio" wire:model="form.encuentras_estudiando"
                                                        id="form.encuentras_estudiando_0"
                                                        name="form.encuentras_estudiando" type="radio" value="0" />No
                                                </x-input-label>
                                            </div>
                                            <x-input-error :messages="$errors->get('form.encuentras_estudiando')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>
                                    <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando != 0"></div>

                                    <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 0">
                                        <x-input-label class="text-sm/6" for="form.ultimo_grado_alcanzado">{{ __('¿Último grado alcanzado?') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select name="form.ultimo_grado_alcanzado" wire:model='form.ultimo_grado_alcanzado' id="form.ultimo_grado_alcanzado"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :options="$ultimosGrados" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ultimo_grado_alcanzado'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.ultimo_grado_alcanzado')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" >
                                        <x-input-label class="text-sm/6" for="form.posee_discapacidad">{{ __('¿Posees alguna discapacidad') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="px-4 py-3">
                                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                                <x-input-label class="flex items-center gap-4 text-sm/6" for="form.posee_discapacidad_1">
                                                    <x-forms.input-radio type="radio" wire:model.live="form.posee_discapacidad"
                                                        id="form.posee_discapacidad_1" data-value="Si"
                                                        name="form.posee_discapacidad" type="radio" value="1" />Si
                                                </x-input-label>
                                                <x-input-label class="flex items-center gap-4 text-sm/6" for="form.posee_discapacidad_2">
                                                    <x-forms.input-radio type="radio" wire:model.live="form.posee_discapacidad"
                                                        id="form.posee_discapacidad_2" data-value="No"
                                                        name="form.posee_discapacidad" type="radio" value="2" />No
                                                </x-input-label>
                                            </div>
                                            <x-input-error :messages="$errors->get('form.posee_discapacidad')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <div x-show="$wire.form.posee_discapacidad == 1">
                                            <x-input-label class="text-sm/6" for="form.inscripcion_discapacidad_id">
                                                {{ __('¿Cual?') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="px-4 py-3">
                                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                                    @foreach ($discapacidades as $key => $value)
                                                    <div class="relative flex gap-x-3">
                                                        <div class="flex items-center h-6">
                                                            <x-text-input type="checkbox"
                                                                wire:key='inscripcionDiscapacidad{{$key}}'
                                                                wire:model="form.discapacidadesSelect"
                                                                value="{{ $key }}"
                                                                class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                                                id="inscripcion-discapacidad-{{$key}}"
                                                                name="form.discapacidadesSelect"
                                                                data-value="{{ $value }}"
                                                            />
                                                        </div>
                                                        <div class="leading-6 text-sm/6">
                                                            <label for="inscripcion-discapacidad-{{$key}}" class="text-sm/6">{{ $value }}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <x-input-error :messages="$errors->get('form.discapacidadesSelect')" class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" >
                                        <x-input-label class="text-sm/6" for="form.sede_departamento_id">{{ $labels['departamento_escuela'] }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select-nna name="form.sede_departamento_id" wire:model.live='form.sede_departamento_id' id="form.sede_departamento_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :selectedValue="$form->sede_departamento_id"
                                                :options="$departamentos" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.sede_departamento_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.sede_departamento_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" >
                                        <x-input-label class="text-sm/6" for="form.sede_ciudad_id">{{ $labels['minicipio_escuela'] }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select-nna name="form.sede_ciudad_id" wire:model.live='form.sede_ciudad_id' id="form.sede_ciudad_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :selectedValue="$form->sede_ciudad_id"
                                                :options="$form->laboraCiudades" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.sede_ciudad_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.sede_ciudad_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" >
                                        <x-input-label class="text-sm/6" for="form.sede_id">{{ __('Selecciona la sede/escuela a la que perteneces') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select-nna name="form.sede_id" wire:model='form.sede_id' id="form.sede_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :selectedValue="$form->sede_id"
                                                :options="$form->perteneceSede" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.sede_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.sede_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 1">
                                        <x-input-label class="text-sm/6" for="form.grado_id">{{ __('Selecciona tu grado actual:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select name="form.grado_id" wire:model='form.grado_id' id="form.grado_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :options="$nivelesAcademicos" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.grado_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.grado_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 1">
                                        <x-input-label class="text-sm/6" for="form.seccion_id">{{ __('Selecciona tu sección:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select name="form.seccion_id" wire:model='form.seccion_id' id="form.seccion_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :options="$secciones" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.seccion_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.seccion_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 1">
                                        <x-input-label class="text-sm/6" for="form.turno_id">{{ __('Selecciona el turno o jornada en la que estudias:') }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select name="form.turno_id" wire:model='form.turno_id' id="form.turno_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :options="$turnos" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.turno_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.turno_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>


                                    <div class="sm:col-span-3" >
                                        <x-input-label class="text-sm/6" for="form.departamento">{{ $labels['departamento'] }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select-nna name="form.departamento_id" wire:model.live='form.departamento_id' id="form.departamento_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :selectedValue="$form->departamento_id"
                                                :options="$departamentos" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.departamento_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.departamento_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3" >
                                        <x-input-label class="text-sm/6" for="form.ciudad_id">{{ $labels['minicipio'] }}
                                            <x-required-label />
                                        </x-input-label>
                                        <div class="mt-2">
                                            <x-forms.single-select-nna name="form.ciudad_id" wire:model.live='form.ciudad_id' id="form.ciudad_id"
                                                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                                :selectedValue="$form->ciudad_id"
                                                :options="$form->ciudades" selected="Seleccione una opción" @class([ 'h-12 text-sm/6',
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ciudad_id'),
                                                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                                                ]) />
                                            <x-input-error :messages="$errors->get('form.ciudad_id')" class="mt-2" aria-live="assertive" />
                                        </div>
                                    </div>
                                </div>


                                <div class="pt-4 pb-6">
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="flex justify-end px-4 py-4 shrink-0">
                          <button type="button" class="px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                          @click="$wire.openDrawer = false">Cancelar</button>
                          <button type="submit" class="inline-flex justify-center px-3 py-2 ml-4 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Actualizar</button>
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
