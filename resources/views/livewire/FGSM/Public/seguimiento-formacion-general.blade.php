<div class="px-4 sm:px-0">

    <div class="flex flex-col items-center justify-between sm:flex-row">
        <div class="flex w-full mb-4 sm:w-1/2 sm:mb-0">
            <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-auto sm:w-4/5">
        </div>
        <div class="flex justify-end w-full sm:w-1/2">
            <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-auto sm:w-4/5">
        </div>
    </div>

    <h1 class="mt-10 mb-10 text-4xl font-bold text-center">Formulario de inscripción y asistencia: <br/>Seguimiento de formación general</h1>
    <p class="mt-4 text-lg leading-7 text-justify text-gray-700">
        ¡Hola! Te damos la bienvenida a Glasswing International. Es un agrado que continues participando en nuestras actividades. Este formulario deberá ser llenado en cada actividad de seguimiento que participes ya que servirá
        para tomar asistencia en dicha actividad. Recuerda que debes usar tu información completa para evitar
        confusiones y que Glasswing seguirá protocolos de seguridad para resguardar tu información. Toda la información
        será guardada con estricta confidencialidad y nada de lo que compartas tendrá repercusiones sobre tu persona o
        tu participación en las actividades. Si tienes consultas sobre este formulario, puedes hacerlas a la persona
        líder de la actividad en cualquier momento. ¡Muchas gracias!
    </p>
    <p class="mt-4 text-lg leading-7 text-justify text-gray-700">
        <span class="font-bold">Aclaración: </span>si participas en más de un seguimiento de SanaMente, deberás llenar este formulario nuevamente; sin embargo, tus datos de identificación serán autocompletados con nuestra base de datos con la información que anteriormente tu nos has brindado.
    </p>

    @auth
        <div class="mt-10">
            <a href="{{ route('admin.seguimiento.index') }}" wire:navigate
                class="block w-full px-8 py-3 font-medium text-white rounded-lg bg-azul-glasswing text-uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline-block w-5 h-5 mr-2 size-5">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                  </svg>

                Volver al visualizador
            </a>
        </div>
    @endauth

    <form wire:submit='save'>
        <div class="space-y-12">

            <div class="pt-12 pb-12 border-b border-gray-900/10">


                <div class="sm:col-span-3">
                    <x-input-label for="form.participacion" class="sm:text-lg">{{ __('¿Es la primera vez que participas en un taller de seguimiento de FGSM?') }} <x-required-label /></x-input-label>
                    <div class="px-4 py-3">
                        <div class="flex gap-6">
                            <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                <x-forms.input-radio type="radio" wire:model.live="form.participacion" id="form.participacion" wire:key="participacion1"
                                name="form.participacion" type="radio" value="1" class="h-12 sm:text-lg"/>
                                Si
                            </x-input-label>
                            <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                <x-forms.input-radio type="radio" wire:model.live="form.participacion" id="form.participacion" wire:key="participacion2"
                                name="form.participacion" type="radio" value="2" class="h-12 sm:text-lg"/>
                                No
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.participacion')" class="mt-2" aria-live="assertive"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-3">
                        <x-input-label for="form.nacionalidad" class="sm:text-lg">{{ __('Nacionalidad') }} <x-required-label /></x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex gap-6">
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad" id="form.nacionalidad" wire:key="nacionalidad1"
                                    name="form.nacionalidad" type="radio" value="1" class="h-12 sm:text-lg"/>
                                    Nacional
                                </x-input-label>
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad" id="form.nacionalidad" wire:key="nacionalidad2"
                                    name="form.nacionalidad" type="radio" value="2" class="h-12 sm:text-lg"/>
                                    Extranjero
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.nacionalidad')" class="mt-2" aria-live="assertive"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.documento_identidad">
                            @if ($pais->id == \App\Models\Pais::MEXICO)
                            {{ __('Escribe tu número de identificador ID: (Tu ID se compone de las primeras 4 letras de tu CURP hasta la fecha de nacimiento dd/mm/aa)') }}
                            @else
                            {{ __('Documento unico de identidad') }}
                            @endif

                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.documento_identidad" id="form.documento_identidad"
                                name="form.documento_identidad" type="text"
                                placeholder="{{ $form->duiplaceholder }}"
                                x-mask="{{ $form->dniformat }}"
                                {{--
                                disabled="{{ $form->readonly ? 'disabled' : '' }}" --}}
                                @class([ 'h-12 sm:text-lg' ,
                                // 'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none'=>
                                // $form->readonly,
                                'block w-full mt-1','border-2 border-red-500' =>
                                $errors->has('form.documento_identidad')
                                ])
                                />
                                <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.nombres">{{ __('Nombres') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model="form.nombres" id="form.nombres" name="form.nombres"
                                type="text" {{-- disabled="{{ $form->readonly ? 'disabled' : '' }}" --}}
                                @class([ 'h-12 sm:text-lg' ,
                                // 'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none'=>
                                // $form->readonly,
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres')
                                ])
                                />
                                <x-input-error :messages="$errors->get('form.nombres')" class="mt-2" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.apellidos">{{ __('Apellidos') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model="form.apellidos" id="form.apellidos" name="form.apellidos"
                                type="text" {{-- disabled="{{ $form->readonly ? 'disabled' : '' }}" --}}
                                @class([ 'h-12 sm:text-lg' ,
                                // 'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none'=>
                                // $form->readonly,
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.apellidos')
                                ])
                                />
                                <x-input-error :messages="$errors->get('form.apellidos')" class="mt-2" />
                        </div>
                    </div>






                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg" for="form.perfil">{{ __('Selecciona su perfil') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select name="perfiles" id="perfilSelected" wire:model.live="form.perfilSelected"
                             x-on:change="const selectedOption = event.target.options[event.target.selectedIndex];
                                const perfilOptions = selectedOption.getAttribute('data-perfil-options');
                                $wire.set('form.perfilSelectedPivot', perfilOptions);"
                                @class([
                                    'h-12 block w-full rounded-md sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-lg',
                                    'border-2 border-red-500' => $errors->has('form.perfilSelected')
                                ])
                                >
                                <option value="">{{ __('Seleccione un perfil') }}</option>
                                @foreach($perfiles as $perfil)
                                    @if ($perfil->id == $form->tipoPerfilPolicia  && $form->disabledPolicia)
                                        @continue
                                    @endif
                                    <option value="{{ $perfil->id }}" data-perfil-options="{{ $perfil->pivotid }}">
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('form.perfilSelected')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>


                    {{-- <div class="sm:col-span-3" x-data="perfilDocenteJs" x-show="showDiv"> --}}
                    <div class="col-span-full" x-show="Array.from($wire.form.tipoPerfilDocente).includes(+$wire.form.perfilSelected)">
                        <x-input-label class="sm:text-lg" for="form.perfilDocenteSelected">{{ __('Seleccione su perfil
                            docente:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select name="perfilDocenteSelected" id="form.perfilDocenteSelected" wire:model="form.perfilDocenteSelected"
                             x-on:change="const selectedOption = event.target.options[event.target.selectedIndex];
                                const perfilDocenteOptions = selectedOption.getAttribute('data-perfil-docente-options');
                                $wire.set('form.perfilDocenteSelectedPivot', perfilDocenteOptions);"
                                @class([
                                    'h-12 block w-full rounded-md sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-lg',
                                    'border-2 border-red-500' => $errors->has('form.perfilDocenteSelected')
                                ])
                                >
                                <option value="">{{ __('Seleccione un perfil') }}</option>
                                @foreach($perfilDocente as $perfil)
                                    <option value="{{ $perfil->id }}" data-perfil-docente-options="{{ $perfil->pivotid }}">
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('form.perfilDocenteSelected')" class="mt-2"
                                    aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full" x-show="$wire.form.perfilSelected == {{ $form->tipoPerfilPolicia }}">
                        <x-input-label class="sm:text-lg" for="form.perfilPoliciaSelected">{{ __('Selecciona su perfil
                            policia:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select name="perfilPoliciaSelected" id="form.perfilPoliciaSelected" wire:model="form.perfilPoliciaSelected"
                             x-on:change="const selectedOption = event.target.options[event.target.selectedIndex];
                                const perfilOptions = selectedOption.getAttribute('data-perfil-options');
                                $wire.set('form.perfilPoliciaSelectedPivot', perfilOptions);"
                                @class([
                                    'h-12 block w-full rounded-md sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-lg',
                                    'border-2 border-red-500' => $errors->has('form.perfilPoliciaSelected')
                                ])
                                >
                                <option value="">{{ __('Seleccione un perfil') }}</option>
                                @foreach($perfilPolicia as $perfil)
                                    <option value="{{ $perfil->id }}" data-perfil-options="{{ $perfil->pivotid }}">
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('form.perfilPoliciaSelected')" class="mt-2"
                                    aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full"
                        x-show="$wire.form.perfilPoliciaSelected == {{ $form->tipoPerfilPoliciaNacional }} && $wire.form.perfilSelected == {{ $form->tipoPerfilPolicia }}">
                        <x-input-label class="sm:text-lg" for="rangoPoliciaSelected">{{ __('Selecciona su
                            rango/categoria:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select name="rangoPoliciaSelected" id="form.rangoPoliciaSelected" wire:model="form.rangoPoliciaSelected"
                             x-on:change="const selectedOption = event.target.options[event.target.selectedIndex];
                                const perfilOptions = selectedOption.getAttribute('data-perfil-options');
                                $wire.set('form.rangoPoliciaSelectedPivot', perfilOptions);"
                                @class([
                                    'h-12 block w-full rounded-md sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-lg',
                                    'border-2 border-red-500' => $errors->has('form.rangoPoliciaSelected')
                                ])
                                >
                                <option value="">{{ __('Seleccione un perfil') }}</option>
                                @foreach($rangoPolicia as $perfil)
                                    <option value="{{ $perfil->id }}" data-perfil-options="{{ $perfil->pivotid }}">
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>
                                <x-input-error :messages="$errors->get('form.rangoPoliciaSelected')" class="mt-2"
                                    aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full"
                         x-show="$wire.form.perfilSelected == {{ $form->tipoPerfilOrganizaciones }}">
                        <x-input-label class="sm:text-lg" for="perfilOrganizacionSelected">{{ __('Selecciona su perfil
                            organizaciones:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select name="perfilOrganizacionSelected" id="form.perfilOrganizacionSelected" wire:model="form.perfilOrganizacionSelected"
                             x-on:change="const selectedOption = event.target.options[event.target.selectedIndex];
                                const perfilOptions = selectedOption.getAttribute('data-perfil-options');
                                $wire.set('form.perfilOrganizacionSelectedPivot', perfilOptions);"
                                @class([
                                    'h-12 block w-full rounded-md sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-lg',
                                    'border-2 border-red-500' => $errors->has('form.perfilOrganizacionSelected')
                                ])
                                >
                                <option value="">{{ __('Seleccione un perfil') }}</option>
                                @foreach($perfilOrganizaciones as $perfil)
                                    <option value="{{ $perfil->id }}" data-perfil-options="{{ $perfil->pivotid }}">
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>
                                <x-input-error :messages="$errors->get('form.perfilOrganizacionSelected')" class="mt-2"
                                    aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full"
                    x-show="$wire.form.perfilSelected == {{ $form->tipoPerfilSalud }}">
                        <x-input-label class="sm:text-lg" for="perfilSaludSelected">{{ __('Selecciona su perfil salud:')
                            }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select name="perfilSaludSelected" id="form.perfilSaludSelected" wire:model="form.perfilSaludSelected"
                             x-on:change="const selectedOption = event.target.options[event.target.selectedIndex];
                                const perfilOptions = selectedOption.getAttribute('data-perfil-options');
                                $wire.set('form.perfilSaludSelectedPivot', perfilOptions);"
                                @class([
                                    'h-12 block w-full rounded-md sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-lg',
                                    'border-2 border-red-500' => $errors->has('form.perfilSaludSelected')
                                ])
                                >
                                <option value="">{{ __('Seleccione un perfil') }}</option>
                                @foreach($perfilSalud as $perfil)
                                    <option value="{{ $perfil->id }}" data-perfil-options="{{ $perfil->pivotid }}">
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>
                                <x-input-error :messages="$errors->get('form.perfilSaludSelected')" class="mt-2"
                                    aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full" x-show="Array.from($wire.form.tipoPerfilSaludArray).includes(+$wire.form.perfilSaludSelected)">
                        <x-input-label class="sm:text-lg" for="perfilHospitalSelected">{{ __('Selecciona su perfil de
                            personal de salud:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select name="perfilHospitalSelected" id="form.perfilHospitalSelected" wire:model="form.perfilHospitalSelected"
                             x-on:change="const selectedOption = event.target.options[event.target.selectedIndex];
                                const perfilOptions = selectedOption.getAttribute('data-perfil-options');
                                $wire.set('form.perfilHospitalSelectedPivot', perfilOptions);"
                                @class([
                                    'h-12 block w-full rounded-md sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-lg',
                                    'border-2 border-red-500' => $errors->has('form.perfilHospitalSelected')
                                ])
                                >
                                <option value="">{{ __('Seleccione un perfil') }}</option>
                                @foreach($perfilHospital as $perfil)
                                    <option value="{{ $perfil->id }}" data-perfil-options="{{ $perfil->pivotid }}">
                                        {{ $perfil->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('form.perfilHospitalSelected')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="departamentoSelected">{{ __('Selecciona el departamento
                            donde se encuentra la escuela/sede a la que pertenece:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-forms.single-select name="departamentoSelected" wire:model.live='form.departamentoSelected'
                                {{-- disabled="{{ $form->readonly ? 'disabled' : '' }}" --}} id="departamentoSelected"
                                :options="$departamentos" selected="Seleccione un departamento" @class([ 'h-12 sm:text-lg' ,
                                // 'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none'=>
                                $form->readonly,
                                'block w-full mt-1','border-2 border-red-500' =>
                                $errors->has('form.departamentoSelected')
                                ])
                                />
                                <x-input-error :messages="$errors->get('form.departamentoSelected')" class="mt-2"
                                    aria-live="assertive" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="ciudadSelected">{{ __('Selecciona el municipio donde se
                            encuentra la escuela/sede a la que perteneces:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <select
                            wire:model.live='form.ciudadSelected'
                            class="block w-full h-12 border-gray-300 rounded-md shadow-sm sm:text-lg sm:leading-6 focus:border-indigo-500 focus:ring-indigo-500"
                            >

                                <option value="" {{ (!$form->ciudadSelected) ? 'selected': '' }}>Seleccione un municipio</option>
                                @foreach ($form->ciudades as $key => $value)
                                <option value="{{ $key }}" {{ $form->ciudadSelected == $key ? "selected" : "" }}
                                        wire:key='ciudadSelected{{ '-'. $key }}'>{{ $value }}</option>
                                @endforeach
                            </select>

                                <x-input-error :messages="$errors->get('form.ciudadSelected')" class="mt-2"
                                    aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full" >
                        <x-input-label  class="sm:text-lg" for="form.escuelaSelected">{{ __('Selecciona la sede/escuela a la que perteneces:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <div wire:ignore>
                                <select
                                    data-choice
                                    wire:change="$set('form.escuelaSelected', $event.target.value)"
                                    id="escuelaSelectedChoices"
                                    @class([
                                        'block w-full mt-1 h-12 sm:text-lg',
                                        'border-2 border-red-500' => $errors->has('form.escuelaSelected')
                                    ])
                                >
                                    <option value="">Seleccione una sede/escuela</option>
                                    @foreach($form->escuelas as $key => $value)
                                        <option value="{{ $key }}" @selected($key == $form->escuelaSelected)>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('form.escuelaSelected')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="actividades">{{ __('Selecciona la actividad en la que
                            participas:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <div class="px-4 py-3">
                                <div class="max-w-2xl space-y-10">
                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                        @foreach ($actividades as $key => $value)
                                        <div class="relative flex gap-x-3">
                                            <div class="flex items-center h-6">
                                                <x-text-input type="checkbox"
                                                    wire:key='actividad{{$key}}' {{--
                                                    disabled="{{ $form->readonly ? 'disabled' : '' }}" --}}
                                                    wire:model="form.actividadesSelected" value="{{ $key}}"
                                                    class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                                    id="actividad-{{$key}}" />
                                            </div>
                                            <div class="leading-6 sm:text-lg">
                                                <label for="actividad-{{$key}}"
                                                    class="text-sm font-medium text-gray-900 sm:text-lg">{{ $value
                                                    }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('form.actividadesSelected')" class="mt-2"
                                        aria-live="assertive" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.numero_grupo_participa">{{ __('Escribe el número de grupo en el que participas:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.numero_grupo_participa" id="form.numero_grupo_participa"
                                name="form.numero_grupo_participa" type="text" {{--
                                disabled="{{ $form->readonly ? 'disabled' : '' }}" --}} @class([ 'h-12 sm:text-lg' ,
                                // 'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none'=>
                                $form->readonly,
                                'block w-full mt-1','border-2 border-red-500' =>
                                $errors->has('form.numero_grupo_participa')
                                ])
                                />
                                <x-input-error :messages="$errors->get('form.numero_grupo_participa')" class="mt-2" />
                        </div>

                        <div class="mt-8">
                            <x-input-label class="sm:text-lg" for="form.fecha_participo_actividad">{{ __('Seleccione la fecha en la que participó en la actividad:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model="form.fecha_participo_actividad" id="form.fecha_participo_actividad"
                                    name="form.fecha_participo_actividad" type="date"
                                    max="{{ now()->toDateString() }}"
                                    @class([ 'h-12 sm:text-lg' ,
                                    // 'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none'=>
                                    $form->readonly,
                                    'block w-full mt-1','border-2 border-red-500' =>
                                    $errors->has('form.fecha_participo_actividad')
                                    ])
                                    />
                                    <x-input-error :messages="$errors->get('form.fecha_participo_actividad')" class="mt-2" />
                            </div>
                        </div>
                        <div class="mt-8">
                            <x-input-label class="sm:text-lg" for="form.intervencionistaSelected">{{ __('Persona que lidera la actividad:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model="form.formador" id="form.formador" name="form.formador"
                                type="text" readonly
                                @class([ 'h-12 sm:text-lg disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.formador')
                                ])
                                />
                            </div>
                        </div>

                    </div>

                </div>
            </div>


        </div>

        <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
            <button type="submit"
                class="relative w-full px-8 py-3 font-medium text-white rounded-lg bg-azul-glasswing text-uppercase disabled:cursor-not-allowed disabled:opacity-75">
                GUARDAR
                <div wire:loading.flex wire:target="save"
                    class="absolute top-0 bottom-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </button>
        </div>
    </form>

<x-notifications.modal-confirmacion-finalizar>
    <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">¡Proceso finalizado!</h3>
    <div class="mt-2">
        <p class="text-lg text-gray-500">Gracias {{ $form->nombres.' '.$form->apellidos }} por completar el proceso, su código de confirmación es: <span class="font-semibold">
            {{ $form->seguimiento->codigo_confirmacion ?? '' }}</span></p>
    </div>
</x-notifications.modal-confirmacion-finalizar>


 <!-- Error Indicator... -->
 <x-notifications.error-text-notification message="Han habido errores en el formulario" />

 <!-- Error Alert... -->
 <x-notifications.alert-error-notification>
     <p class="text-sm font-medium text-red-900">¡Errores en el formulario!</p>
     <p class="mt-1 text-sm text-gray-500">Han habido problemas para guardar los cambios, corrija cualquier
         error en el formulario e intente nuevamente.</p>
 </x-notifications.alert-error-notification>




@script
<script>
    Alpine.data('perfilDocenteJs', () => ({

showDiv: false,

init() {

    this.showDiv = Array.from(this.$wire.form.tipoPerfilDocente).includes($wire.form.perfilSelected);
    //console.log(this.showDiv);

    this.$watch('$wire.form.perfilSelected', () => {
        this.checkPerfilDocenteOnChanged()
    })

},
checkPerfilDocenteOnChanged() {
    const arrayExtracted = Array.from(this.$wire.form.tipoPerfilDocente);
    this.showDiv = arrayExtracted.includes(+$wire.form.perfilSelected);
},

}));
</script>
@endscript

@script
<script>
    document.addEventListener('livewire:navigated', function () {
        // Initialize Choices.js for the second dropdown
        // new Choices($wire.$el.querySelector('[data-intervencionistas]'), { shouldSort: false });
        let subcategorySelect = new Choices($wire.$el.querySelector('[data-choice]'), { shouldSort: false });
        // Listen for changes in Livewire and update the second dropdown accordingly
        Livewire.on('refresh-choices', subcategories => {

            // Get the dropdown element
            let subcategoryElement = document.getElementById('escuelaSelectedChoices');

            subcategoryElement.innerHTML = '';
            subcategoryElement.innerHTML = '<option value="">Seleccione una sede/escuela</option>';

            for (const [key, value] of Object.entries(subcategories[0])) {

                let newOption = new Option(value, key);
                if ($wire.form.escuelaSelected == key) {
                    newOption.selected = true;
                }
                subcategoryElement.add(newOption);
            }


            subcategorySelect.refresh();
        });
    });
</script>
@endscript

<style>
.choices__inner{
    background-color: white !important;
}
.choices[data-type*=select-one] .choices__input {
    display: block;
    width: 100%;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    background-color: #fff;
    margin: 0;
    font-size: 1.125rem !important;
    line-height: 1.75rem !important;
}
.choices__list--single .choices__item{
    font-size: 1.125rem !important;
    line-height: 1.75rem !important;
}
.choices__list--dropdown .choices__item, .choices__list[aria-expanded] .choices__item {
    font-size: 18px;
}
</style>
