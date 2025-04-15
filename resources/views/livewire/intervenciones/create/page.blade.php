<div class="px-4 sm:px-0">

    <div class="flex flex-col items-center justify-between sm:flex-row">
        <div class="flex w-full mb-4 sm:w-1/2 sm:mb-0">
            <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-auto sm:w-4/5">
        </div>
        <div class="flex justify-end w-full sm:w-1/2">
            <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-auto sm:w-4/5">
        </div>
    </div>

    <h1 class="mt-10 mb-10 text-4xl font-bold text-center">Formulario de registro de intervenciones directas</h1>
    <p class="mt-4 text-lg leading-7 text-justify text-gray-700">
        ¡Buen día! Recuerda que este formulario debe ser llenado cada vez que realices un acercamiento a una persona desde tu rol de intervencionista. En caso sea una persona que se atiende por primera vez se deberá llenar la parte de datos de identificación completa, de lo contrario si se cuenta con documento unico de identidad se deberá buscar a la persona para que automaticamente se completen los datos de identificación.
    </p>

    @auth
        <div class="mt-10">
            <a href="{{ route('admin.intervenciones.index') }}"
                class="block w-full px-8 py-3 font-medium text-white rounded-lg bg-azul-glasswing text-uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline-block w-5 h-5 mr-2 size-5">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                </svg>
                Volver al visualizador
            </a>
        </div>
    @endauth

    <form wire:submit='save' enctype="multipart/form-data">
        <div class="space-y-12">
            <div x-data="formIntervencion" class="pt-12 pb-12 border-b border-gray-900/10">
                {{-- PARTE 1: DATOS DE IDENTIFICACIÓN --}}
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('¿Es la primera intervención recibida?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex gap-6">
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.primera_intervencion"
                                        id="form.primera_intervencion_1"
                                        name="form.primera_intervencion" type="radio" value="1" class="h-12 sm:text-lg"/>
                                    Si
                                </x-input-label>
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.primera_intervencion"
                                        id="form.primera_intervencion_0"
                                        name="form.primera_intervencion" type="radio" value="0" class="h-12 sm:text-lg"/>
                                    No
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.primera_intervencion')" class="mt-2" aria-live="assertive"/>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('La intervención es') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex gap-6">
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.tipo_intervencion"
                                        id="form.tipo_intervencion_1"
                                        name="form.tipo_intervencion" type="radio" value="1" class="h-12 sm:text-lg"/>
                                    Individual
                                </x-input-label>
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.tipo_intervencion"
                                        id="form.tipo_intervencion_2"
                                        name="form.tipo_intervencion" type="radio" value="2" class="h-12 sm:text-lg"/>
                                    Grupal
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.tipo_intervencion')" class="mt-2" aria-live="assertive"/>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-cloak x-show="$wire.form.tipo_intervencion == 2">
                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg" for="psicologico.inicio_intervencion">
                            {{ __('Cantidad de personas que participaron en la intervención:') }}
                        </x-input-label>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.cantidad_hombres">
                            {{ __('Hombres:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model="form.cantidad_hombres" id="form.cantidad_hombres" name="form.cantidad_hombres"
                                type="number" min="0" size="4"
                                @class(['h-12 sm:text-lg', 'block mt-1',
                                'border-2 border-red-500' => $errors->has('form.cantidad_hombres')
                                ]) />
                            <x-input-error :messages="$errors->get('form.cantidad_hombres')" class="mt-2" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.cantidad_mujeres">
                            {{ __('Mujeres:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model="form.cantidad_mujeres" id="form.cantidad_mujeres" name="form.cantidad_mujeres"
                                type="number" min="0" size="4"
                                @class(['h-12 sm:text-lg', 'block mt-1',
                                'border-2 border-red-500' => $errors->has('form.cantidad_mujeres')
                                ]) />
                            <x-input-error :messages="$errors->get('form.cantidad_mujeres')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-cloak x-show="$wire.form.tipo_intervencion == 1">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('¿Desea compartir su información personal?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex gap-6">
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.compartir_informacion"
                                            id="form.compartir_informacion_1" x-on:change="compartir_informacion = true"
                                            name="form.compartir_informacion" type="radio" value="1" class="h-12 sm:text-lg"/>
                                    Si
                                </x-input-label>
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.compartir_informacion"
                                    id="form.compartir_informacion_0" x-on:change="compartir_informacion = false"
                                    name="form.compartir_informacion" type="radio" value="0"  class="h-12 sm:text-lg"/>
                                    No
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.compartir_informacion')" class="mt-2" aria-live="assertive"/>
                        </div>
                    </div>

                    <div class="sm:col-span-3" x-cloak x-show="$wire.form.compartir_informacion == 0">
                        <x-input-label class="sm:text-lg" for="form.sexo">
                            {{ __('Sexo:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.sexo_3">
                                    <x-forms.input-radio type="radio" id="form.sexo_3"
                                        wire:change="$set('form.sexo', $event.target.value)"
                                        name="form.sexo2" type="radio" value="1" />Mujer
                                </x-input-label>
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.sexo_4">
                                    <x-forms.input-radio type="radio" id="form.sexo_4"
                                        wire:change="$set('form.sexo', $event.target.value)"
                                        name="form.sexo2" type="radio" value="2" />Hombre
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.sexo')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-cloak x-show="compartir_informacion && $wire.form.tipo_intervencion == 1">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('¿Eres nacional o extranjero(a)?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex gap-6">
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad"
                                            id="form.nacionalidad_1"
                                            name="form.nacionalidad" type="radio" value="1" class="h-12 sm:text-lg"/>
                                    Nacional
                                </x-input-label>
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad"
                                    id="form.nacionalidad_2"
                                    name="form.nacionalidad" type="radio" value="2"  class="h-12 sm:text-lg"/>
                                    Extranjero(a)
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.nacionalidad')" class="mt-2" aria-live="assertive"/>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.documento_identidad">
                            {{ $form->dni_title }}
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.documento_identidad"
                                id="form.documento_identidad"
                                name="form.documento_identidad"
                                type="text"
                                placeholder="{{ $form->dni_placeholder }}"
                                x-mask="{{ $form->dni_mask }}"
                                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.documento_identidad')
                                ]) />
                            <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.nombres">
                            {{ __('Nombres de la persona intervenida:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.nombres" id="form.nombres" name="form.nombres"
                                type="text" placeholder="Nombres"
                                @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres')
                                ]) />
                            <x-input-error :messages="$errors->get('form.nombres')" class="mt-2" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.apellidos">
                            {{ __('Apellidos de la persona intervenida:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.apellidos" id="form.apellidos" name="form.apellidos"
                                type="text" placeholder="Apellidos"
                                @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.apellidos')
                                ]) />
                            <x-input-error :messages="$errors->get('form.apellidos')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div @class([
                    'grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6',
                    'mt-10' => $form->compartir_informacion == 1,
                ]) x-cloak x-show="$wire.form.tipo_intervencion == 1">
                    <div class="sm:col-span-3" x-cloak x-show="compartir_informacion">
                        <x-input-label class="sm:text-lg" for="form.fecha_nacimiento">
                            {{ __('Fecha de nacimiento:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.fecha_nacimiento" id="form.fecha_nacimiento" name="form.fecha_nacimiento"
                                type="date" max="{{ $form->fecha_nacimiento_max }}"
                                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.fecha_nacimiento')
                                ]) />
                            <x-input-error :messages="$errors->get('form.fecha_nacimiento')" class="mt-2" />
                        </div>
                    </div>
                    <div class="sm:col-span-3" x-cloak x-show="compartir_informacion">
                        <x-input-label class="sm:text-lg" for="form.sexo">
                            {{ __('Sexo:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.sexo_1">
                                    <x-forms.input-radio type="radio" wire:model.live="form.sexo"
                                        id="form.sexo_1"
                                        name="form.sexo" type="radio" value="1" />Mujer
                                </x-input-label>
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.sexo_2">
                                    <x-forms.input-radio type="radio" wire:model.live="form.sexo"
                                        id="form.sexo_2"
                                        name="form.sexo" type="radio" value="2" />Hombre
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.sexo')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-cloak x-show="$wire.form.tipo_intervencion == 1">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('¿Posee alguna discapacidad?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex gap-6">
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.discapacidad"
                                        id="form.discapacidad_1" name="form.discapacidad"
                                        type="radio" value="1" class="h-12 sm:text-lg"/>
                                    Si
                                </x-input-label>
                                <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                    <x-forms.input-radio type="radio" wire:model.live="form.discapacidad"
                                        id="form.discapacidad_2" name="form.discapacidad"
                                        type="radio" value="2"  class="h-12 sm:text-lg"/>
                                    No
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.discapacidad')" class="mt-2" aria-live="assertive"/>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <div x-show="$wire.form.discapacidad == 1">
                            <x-input-label class="sm:text-lg" for="form.discapacidad_id">
                                {{ __('¿Cual?') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                    @foreach ($discapacidades as $key => $value)
                                    <div class="relative flex gap-x-3">
                                        <div class="flex items-center h-6">
                                            <x-text-input type="checkbox"
                                                wire:key='intervencionDiscapacidad{{$key}}'
                                                wire:model="form.discapacidad_id"
                                                value="{{ $key }}"
                                                class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                                id="inscripcion-discapacidad-{{$key}}"
                                                name="form.discapacidad_id"
                                                data-value="{{ $value }}"
                                            />
                                        </div>
                                        <div class="leading-6 sm:text-lg">
                                            <label for="inscripcion-discapacidad-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('form.discapacidad_id')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.perfil_participante_id">
                            {{ __('Perfil de participante:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2" x-cloak x-show="$wire.form.tipo_intervencion != 2">
                            <x-forms.single-select name="form.perfil_participante_id" wire:model='form.perfil_participante_id' id="form.perfil_participante_id"
                                :options="$perfil_participante" selected="Seleccione un perfil" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_participante_id')
                                ]) />
                            <x-input-error :messages="$errors->get('form.perfil_participante_id')" class="mt-2" aria-live="assertive" />
                        </div>
                        <div class="px-4 py-3" x-cloak x-show="$wire.form.tipo_intervencion == 2">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                @foreach ($perfil_participante as $key => $value)
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-text-input type="checkbox"
                                            wire:key='intervencionPerfilParticipante{{$key}}'
                                            wire:model="form.perfil_participante"
                                            value="{{ $key }}"
                                            class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                            id="intervencion-perfilparticipante-{{$key}}"
                                            name="form.perfil_participante"
                                            data-value="{{ $value }}"
                                        />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <label for="intervencion-perfilparticipante-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('form.perfil_participante')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.departamento_id">
                            {{ __('Departamento de la sede de intervención:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-forms.single-select name="form.departamento_id" wire:model.live='form.departamento_id' id="form.departamento_id"
                                :options="$departamentos" selected="Seleccione un departamento" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.departamento_id')
                                ]) />
                            <x-input-error :messages="$errors->get('form.departamento_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.ciudad_id">
                            {{ __('Municipio de la sede de intervención:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-forms.single-select name="form.ciudad_id" wire:model.live='form.ciudad_id' id="form.ciudad_id"
                                :options="$form->ciudades" selected="Seleccione un municipio" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ciudad_id')
                                ]) />
                            <x-input-error :messages="$errors->get('form.ciudad_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.sede_id">
                            {{ __('Sede de intervención:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <div wire:ignore>
                                <x-forms.single-select name="form.sede_id" wire:change="$set('form.sede_id', $event.target.value)"
                                :options="$form->sedes" selected="Seleccione una sede" id="form.sede_id" data-choice
                                @class([ 'h-12 sm:text-lg', 'block w-full mt-1','border-2 border-red-500' => $errors->has('form.sede_id')
                                ]) />
                            </div>
                            <x-input-error :messages="$errors->get('form.sede_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                </div>
                {{-- END - PARTE 1: DATOS DE IDENTIFICACIÓN --}}


                {{-- PARTE 2: DATOS DE INTERVENCIÓN --}}
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.fecha_intervencion">
                            {{ __('Fecha de intervención:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.fecha_intervencion" id="form.fecha_intervencion" name="form.fecha_intervencion"
                                type="date" max="{{ $form->fecha_intervencion_max }}"
                                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.fecha_intervencion')
                                ]) />
                            <x-input-error :messages="$errors->get('form.fecha_intervencion')" class="mt-2" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.tipo_intervencion_id">
                            {{ __('Seleccione el tipo de intervención que se realizó:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                @foreach ($tipo_intervencion as $key => $value)
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-text-input type="checkbox"
                                            wire:key='tipointervencion{{$key}}'
                                            wire:model="form.tipo_intervencion_id"
                                            value="{{ $key }}"
                                            class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                            id="tipo-intervencion-{{$key}}"
                                            name="form.tipo_intervencion_id"
                                            x-on:change="tipoIntervencionDropdown"
                                            data-value="{{ $value }}"
                                        />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <label for="tipo-intervencion-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('form.tipo_intervencion_id')" class="mt-2 tipo-intervencion-error" aria-live="assertive" />
                        </div>
                    </div>
                </div>
                {{-- END - PARTE 2: DATOS DE INTERVENCIÓN --}}


                {{-- TIEMPO DE INTERVENCION --}}
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="tiempo_intervencion">
                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg" for="psicologico.inicio_intervencion">
                            {{ __('Coloque la hora de inicio de la intervención:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.inicio_intervencion"
                                id="psicologico.inicio_intervencion" name="psicologico.inicio_intervencion" type="time"
                                @class(['h-12 sm:text-lg', 'block mt-1' ])/>
                            <x-input-error :messages="$errors->get('form.inicio_intervencion')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                </div>
                {{-- END - TIEMPO DE INTERVENCION --}}


                {{-- PARTE 3: PROTOCOLO SANAMENTE --}}
                @if ($form->menor == false)
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="protocolo_sanamente">
                    <div class="col-span-full">
                        <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('Protocolo SanaMente') }}</h3>
                    </div>

                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.sede_id">
                            {{ __('Seleccione el tipo de psicoeducación brindada:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                @foreach ($tipo_psicoeducacion as $key => $value)
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-text-input type="checkbox"
                                            wire:key='psicoeducacion{{$key}}'
                                            wire:model.live="form.tipo_psicoeducacion_id" value="{{ $key}}"
                                            class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                            id="psicoeducacion-{{$key}}" />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <label for="psicoeducacion-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('form.tipo_psicoeducacion_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.sede_id">
                            {{ __('Seleccione la estrategia utilizada en el caso:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                @foreach ($estrategias as $key => $value)
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-text-input type="checkbox"
                                            wire:key='estrategia{{$key}}'
                                            wire:model.live="form.estrategia_id" value="{{ $key}}"
                                            class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                            id="estrategia-{{$key}}" />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <label for="estrategia-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('form.estrategia_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg">
                            {{ __('¿Se pausó el protocolo?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.pauso_protocolo_1">
                                    <x-forms.input-radio type="radio" wire:model.live="form.pauso_protocolo"
                                        id="form.pauso_protocolo_1" x-on:change="pauso_protocolo = true"
                                        name="form.pauso_protocolo" type="radio" value="1" />Si
                                </x-input-label>
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.pauso_protocolo_0">
                                    <x-forms.input-radio type="radio" wire:model.live="form.pauso_protocolo"
                                        id="form.pauso_protocolo_0" x-on:change="pauso_protocolo = false"
                                        name="form.pauso_protocolo" type="radio" value="0" />No
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.pauso_protocolo')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="pauso_protocolo">
                    <div class="sm:col-span-3">
                        <div>
                            <x-input-label class="sm:text-lg" for="form.pauso_protocolo_id">
                                {{ __('¿Por qué?') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-forms.single-select name="form.pauso_protocolo_id" wire:model.live='form.pauso_protocolo_id' id="form.pauso_protocolo_id"
                                    :options="$pauso_protocolos" selected="Seleccione el motivo" @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.pauso_protocolo_id')
                                    ]) x-on:change="pausoProtocoloDropdown" />
                                <x-input-error :messages="$errors->get('form.pauso_protocolo_id')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <div x-show="pauso_protocolo_otros">
                            <x-input-label class="sm:text-lg" for="form.pauso_protocolo_otros">
                                {{ __('Otros motivos:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model.blur="form.pauso_protocolo_otros"
                                    id="form.pauso_protocolo_otros" name="form.pauso_protocolo_otros" type="text"
                                    @class(['h-12 sm:text-lg', 'block w-full mt-1' ])/>
                                <x-input-error :messages="$errors->get('form.pauso_protocolo_otros')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full" x-show="pauso_protocolo_tiempo">
                        <x-input-label class="sm:text-lg" for="form.pauso_intervencion">
                            {{ __('¿Cuánto tiempo se pausó el protocolo?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.pauso_intervencion"
                                id="form.pauso_intervencion" name="form.pauso_intervencion"
                                type="text" placeholder="hora:minuto" x-mask="99:99" size="10"
                                @class(['h-12 sm:text-lg', 'block mt-1' ])/>
                            <x-input-error :messages="$errors->get('form.pauso_intervencion')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="protocolo_sanamente">
                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg" for="form.pauso_protocol_otros">
                            {{ __('Adjunte el consentimiento informado de la persona participante:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            @if(isset($form->consentimiento_archivo))
                                <div class="py-2">
                                    @if (str_contains($form->consentimiento_archivo, 'intervenciones/protocolo-sanamente'))
                                        <a href="{{ Storage::disk('s3')->temporaryUrl($form->consentimiento_archivo, \Carbon\Carbon::now()->addHour()) }}"
                                            class="text-blue-600 underline md:text-green-600"
                                            target="_blank" rel="noopener noreferrer">
                                            Ver documento actual
                                        </a>
                                    @else
                                        <a href="{{ Storage::url($form->consentimiento_archivo) }}"
                                            class="text-blue-600 underline md:text-green-600"
                                            target="_blank" rel="noopener noreferrer">
                                            Ver documento actual
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <input type="file"
                                wire:model="form.consentimiento"
                            @class([
                            "w-full text-sm font-semibold text-gray-400 bg-white border rounded
                            cursor-pointer file:cursor-pointer file:border-0 file:py-3 file:px-4
                            file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500"
                            ]) />
                            <x-intervencion.file-description />
                            <x-input-error :messages="$errors->get('form.consentimiento')" class="mt-2" aria-live="assertive" />
                        </div>

                        @foreach ($form->protocolo_images as $key => $value)
                            <div class="mt-2">
                                @if(isset($form->protocolo_images_uploaded[$key]))
                                    <div class="py-2">
                                        <a href="{{ Storage::disk('s3')->temporaryUrl($form->protocolo_images_uploaded[$key], \Carbon\Carbon::now()->addHour()) }}"
                                            class="text-blue-600 underline md:text-green-600"
                                            target="_blank" rel="noopener noreferrer">
                                            Ver documento actual
                                        </a>
                                    </div>
                                @endif
                                <div class="flex gap-3 flex-nowrap">
                                    <div class="flex-1">
                                        <input type="file"
                                            wire:key="{{ $key }}"
                                            wire:model="form.protocolo_images.{{ $key }}"
                                            @class([
                                            "w-full text-sm font-semibold text-gray-400 bg-white border rounded
                                            cursor-pointer file:cursor-pointer file:border-0 file:py-3 file:px-4
                                            file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500"
                                            ]) />
                                    </div>
                                    @if(isset($form->protocolo_images_uploaded[$key]))
                                        <x-intervencion.delete-image click="deleteProtocoloImage({{ $key }})" />
                                    @else
                                        <x-intervencion.remove-image click="removeProtocoloImage({{ $key }})" />
                                    @endif
                                </div>
                                <x-intervencion.file-description />
                            </div>
                        @endforeach
                        <x-input-error :messages="$errors->get('form.protocolo_images')" class="mt-2" aria-live="assertive" />

                        @if (count($form->protocolo_images) < 2)
                            <div class="mt-2">
                                <x-intervencion.add-image click="addProtocoloImage" />
                            </div>
                        @endif
                    </div>

                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg" for="form.protocolo_comentario">
                            {{ __('Comentarios adicionales del protocolo SanaMente:') }}
                        </x-input-label>
                        <div class="mt-2">
                            <textarea wire:model="form.protocolo_comentario"
                                id="form.protocolo_comentario" rows="3" name="form.protocolo_comentario"
                                @class(['block w-full rounded-md  py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 border-0 border-slate-300',
                                'border-2 border-red-500' => $errors->has('form.protocolo_comentario')
                                ])
                            ></textarea>
                        </div>
                    </div>
                </div>
                @else
                    <div class="py-8 text-lg text-center center" x-show="protocolo_sanamente">
                        <strong>
                            NOTA: Por el momento el protocolo SanaMente esta diseñado unicamente para personas
                            mayores de edad, por lo que al ser la persona menor de edad no aplicaría esta intervención.
                        </strong>
                    </div>
                @endif
                {{-- END - PARTE 3: PROTOCOLO SANAMENTE --}}


                {{-- PARTE 4:PRIMEROS AUXILIOS PSICOLÓGICOS  --}}
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="primeros_auxilios_psicologicos">
                    <div class="col-span-full">
                        <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('Primeros Auxilios Psicológicos') }}</h3>
                    </div>

                    <div class="col-span-full" x-show="primeros_auxilios_psicologicos">
                        <x-input-label class="sm:text-lg" for="form.sede_intervencion_id">
                            {{ __('Seleccione el tipo de Otras intervenciones:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                @foreach ($tipo_otras_intervenciones as $key => $value)
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-text-input type="checkbox"
                                            wire:key='actividad{{$key}}'
                                            wire:model.live="form.tipo_otra_intervencion_id" value="{{ $key}}"
                                            class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                            id="actividad-{{$key}}" />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <label for="actividad-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('form.tipo_otra_intervencion_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg" for="form.psicologicos_comentario">
                            {{ __('Comentarios adicionales de primeros auxilios psicológicos:') }}
                        </x-input-label>
                        <div class="mt-2">
                            <textarea wire:model="form.psicologicos_comentario"
                                id="form.psicologicos_comentario" rows="3" name="form.psicologicos_comentario"
                                @class(['block w-full rounded-md  py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 border-0 border-slate-300',
                                'border-2 border-red-500' => $errors->has('form.psicologicos_comentario')
                                ])
                            ></textarea>
                        </div>
                    </div>

                    <div class="col-span-full" x-cloak x-show="$wire.form.tipo_intervencion != 2">
                        <x-input-label class="sm:text-lg" for="form.psicologicos_consentimiento">
                            {{ __('Adjunte el consentimiento informado de la persona participante:') }}
                        </x-input-label>
                        <div class="mt-2">
                            @if(isset($form->psicologicos_consentimiento))
                                <div class="py-2">
                                    <a href="{{ Storage::disk('s3')->temporaryUrl($form->psicologicos_consentimiento, \Carbon\Carbon::now()->addHour()) }}"
                                        class="text-blue-600 underline md:text-green-600"
                                        target="_blank" rel="noopener noreferrer">
                                        Ver documento actual
                                    </a>
                                </div>
                            @endif

                            <input type="file" wire:model="form.psicologicos_consentimiento_upload"
                                @class([
                                "w-full text-sm font-semibold text-gray-400 bg-white border rounded
                                cursor-pointer file:cursor-pointer file:border-0 file:py-3 file:px-4
                                file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500"
                                ]) />
                                <x-intervencion.file-description />
                            <x-input-error :messages="$errors->get('form.psicologicos_consentimiento_upload')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                </div>
                {{-- END - PARTE 4:PRIMEROS AUXILIOS PSICOLÓGICOS --}}


                {{-- PARTE 5: Apoyo psicosocial --}}
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="apoyo_psicosocial">
                    <div class="col-span-full">
                        <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('Apoyo psicosocial nivel 2') }}</h3>
                    </div>

                    <div class="col-span-full">
                        <x-input-label class="sm:text-lg" for="form.comentario_apoyo_psicosocial">
                            {{ __('Comentarios adicionales de apoyo psicosocial:') }}
                        </x-input-label>
                        <div class="mt-2">
                            <textarea wire:model="form.comentario_apoyo_psicosocial"
                                id="form.comentario_apoyo_psicosocial" rows="3" name="form.comentario_apoyo_psicosocial"
                                @class(['block w-full rounded-md  py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 border-0 border-slate-300',
                                'border-2 border-red-500' => $errors->has('form.comentario_apoyo_psicosocial')
                                ])
                            ></textarea>
                        </div>
                    </div>
                </div>
                {{-- END - PARTE 5: Apoyo psicosocial --}}


                {{-- PARTE 6: REFERENCIA --}}
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="referencias_titulo">
                    <div class="col-span-full">
                        <h3 class="pt-2 mt-2 text-2xl font-bold text-gray-900">{{ __('Referencia') }}</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="persona_referida">
                    <div class="col-span-full" x-cloak x-show="$wire.form.tipo_intervencion != 2 && persona_referida_opcion">
                        <x-input-label class="sm:text-lg">
                            {{ __('¿La persona fue referida?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.persona_referida_1">
                                    <x-forms.input-radio type="radio" wire:model.live="form.persona_referida"
                                        id="form.persona_referida_1" x-on:change="persona_referida_procesos = true" data-value="Si"
                                        name="form.persona_referida" type="radio" value="1" />Si
                                </x-input-label>
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.persona_referida_0">
                                    <x-forms.input-radio type="radio" wire:model.live="form.persona_referida"
                                        id="form.persona_referida_0" x-on:change="persona_referida_procesos = false" data-value="No"
                                        name="form.persona_referida" type="radio" value="0" />No
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.persona_referida')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>

                    <div class="col-span-full" x-show="referencias_titulo">
                        <x-input-label class="sm:text-lg">
                            {{ __('¿Se realizó la conceptualización del problema?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.conceptualizacion_problema_1">
                                    <x-forms.input-radio type="radio" wire:model.live="form.conceptualizacion_problema"
                                        id="form.conceptualizacion_problema_1" data-value="Si"
                                        name="form.conceptualizacion_problema" type="radio" value="1" />Si
                                </x-input-label>
                                <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.conceptualizacion_problema_0">
                                    <x-forms.input-radio type="radio" wire:model.live="form.conceptualizacion_problema"
                                        id="form.conceptualizacion_problema_0" data-value="No"
                                        name="form.conceptualizacion_problema" type="radio" value="0" />No
                                </x-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.conceptualizacion_problema')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>

                    <div class="sm:col-span-3" x-show="referencias_titulo">
                        <x-input-label class="sm:text-lg" for="form.razon_intervencion_id">
                            {{ __('Selecciona la razón por la que no se realizó la intervención:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-forms.single-select
                                wire:model.live='form.razon_intervencion_id'
                                :options="$razones"
                                selected="Seleccione un protocolo"
                                id="form.razon_intervencion_id"
                                name="form.razon_intervencion_id"
                                x-on:change="razonDropdown"
                                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.razon_intervencion_id')
                                ]) />
                            <x-input-error :messages="$errors->get('form.razon_intervencion_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    <div class="sm:col-span-3" x-show="referencias_titulo">
                        <div x-show="razon_otros">
                            <x-input-label class="sm:text-lg" for="form.razon_otro">
                                <br/>
                                {{ __('Otros:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model.blur="form.razon_otro"
                                    id="form.razon_otro" name="form.razon_otro" type="text"
                                    @class(['h-12 sm:text-lg', 'block w-full mt-1' ])/>
                                <x-input-error :messages="$errors->get('form.razon_otro')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3" x-show="persona_referida_procesos">
                        <x-input-label class="sm:text-lg" for="form.proceso_id">
                            {{ __('¿Qué procesos se activaron a partir de la referencia?') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                @foreach ($procesos as $key => $value)
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-text-input type="checkbox"
                                            wire:key='proceso{{$key}}'
                                            x-on:change="procesosOptions"
                                            wire:model.live="form.proceso_id"
                                            value="{{ $key }}"
                                            data-value="{{ $value }}"
                                            class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                            name="form.proceso_id"
                                            id="proceso-{{$key}}" />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <label for="proceso-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('form.proceso_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    <div class="sm:col-span-3" x-show="persona_referida_procesos">
                        <div x-show="procesos_otros">
                            <x-input-label class="sm:text-lg" for="form.proceso_otro">
                                {{ __('Otros:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model.blur="form.proceso_otro"
                                    id="form.proceso_otro" name="form.proceso_otro" type="text"
                                    @class(['h-12 sm:text-lg', 'block w-full mt-1' ])/>
                                <x-input-error :messages="$errors->get('form.proceso_otro')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full" x-show="persona_referida_procesos">
                        <x-input-label class="sm:text-lg" for="form.referencia">
                            {{ __('Adjuntar documento de respaldo de la referencia') }}
                        </x-input-label>
                        <div class="mt-2">
                            @if(isset($form->referencia_uploaded))
                                <div class="py-2">
                                    @if (str_contains($form->referencia_uploaded, 'intervenciones/referencias'))
                                        <a href="{{ Storage::disk('s3')->temporaryUrl($form->referencia_uploaded, \Carbon\Carbon::now()->addHour()) }}"
                                            class="text-blue-600 underline md:text-green-600"
                                            target="_blank" rel="noopener noreferrer">
                                            Ver documento actual
                                        </a>
                                    @else
                                        <a href="{{ Storage::url($form->referencia_uploaded) }}"
                                            class="text-blue-600 underline md:text-green-600"
                                            target="_blank" rel="noopener noreferrer">
                                            Ver documento actual
                                        </a>
                                    @endif
                                </div>
                            @endif

                            <input type="file"
                                wire:model="form.referencia"
                                @class([
                                "w-full text-sm font-semibold text-gray-400 bg-white border rounded
                                cursor-pointer file:cursor-pointer file:border-0 file:py-3 file:px-4
                                file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500"
                                ]) />
                            <x-intervencion.file-description />
                            <x-input-error :messages="$errors->get('form.referencia')" class="mt-2" aria-live="assertive" />
                        </div>
                        @foreach ($form->referencia_images as $key => $value)
                            <div class="mt-2">
                                @if(isset($form->referencia_images_uploaded[$key]))
                                    <div class="py-2">
                                        <a href="{{ Storage::disk('s3')->temporaryUrl($form->referencia_images_uploaded[$key], \Carbon\Carbon::now()->addHour()) }}"
                                            class="text-blue-600 underline md:text-green-600"
                                            target="_blank" rel="noopener noreferrer">
                                            Ver documento actual
                                        </a>
                                    </div>
                                @endif
                                <div class="flex gap-3 flex-nowrap">
                                    <div class="flex-1">
                                        <input type="file"
                                            wire:key="{{ $key }}"
                                            wire:model="form.referencia_images.{{ $key }}"
                                            @class([
                                            "w-full text-sm font-semibold text-gray-400 bg-white border rounded
                                            cursor-pointer file:cursor-pointer file:border-0 file:py-3 file:px-4
                                            file:mr-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-gray-500"
                                            ]) />
                                    </div>
                                    @if(isset($form->referencia_images_uploaded[$key]))
                                        <x-intervencion.delete-image click="deleteReferenciaImage({{ $key }})" />
                                    @else
                                        <x-intervencion.remove-image click="removeReferenciaImage({{ $key }})" />
                                    @endif
                                </div>
                                <x-intervencion.file-description />
                            </div>
                        @endforeach
                        <x-input-error :messages="$errors->get('form.referencia_images')" class="mt-2" aria-live="assertive" />

                        @if (count($form->referencia_images) < 2)
                            <div class="mt-2">
                                <x-intervencion.add-image click="addReferenciaImage" />
                            </div>
                        @endif
                    </div>

                    <div class="col-span-full" x-show="persona_referida_procesos">
                        <x-input-label class="sm:text-lg" for="form.referencias_comentario">
                            {{ __('Comentarios adicionales de referencia:') }}
                        </x-input-label>
                        <div class="mt-2">
                            <textarea wire:model="form.referencias_comentario"
                                id="form.referencias_comentario" rows="3" name="form.referencias_comentario"
                                @class(['block w-full rounded-md py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 border-0 border-slate-300',
                                'border-2 border-red-500' => $errors->has('form.referencias_comentario')
                                ])
                            ></textarea>
                        </div>
                    </div>
                </div>
                {{-- END - PARTE 6: REFERENCIA --}}


                {{-- TIEMPO DE INTERVENCION --}}
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="tiempo_intervencion">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="psicologico.fin_intervencion">
                            {{ __('Coloque la hora de fin de la intervención:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.fin_intervencion"
                                id="psicologico.fin_intervencion" name="psicologico.fin_intervencion" type="time"
                                @class(['h-12 sm:text-lg', 'block mt-1' ])/>
                            <x-input-error :messages="$errors->get('form.fin_intervencion')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('Total de minutos de la intervención:') }}
                        </x-input-label>
                        <div class="mt-2">
                            <strong>{{ $form->total_intervencion }}</strong>
                            <x-input-error :messages="$errors->get('form.total_intervencion')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                </div>
                {{-- END - TIEMPO DE INTERVENCION --}}


                {{-- PARTE 7: RECONTACTO  --}}
                <div class="mt-9" x-cloak x-show="$wire.form.tipo_intervencion != 2">
                    <div class="col-span-full">
                        <h3 class="py-3 my-3 text-2xl font-bold text-gray-900">{{ __('Recontacto') }}</h3>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="block text-sm font-medium text-gray-700 sm:text-lg" for="form.sede_intervencion_id">
                            {{ __('A la persona participante, ¿le gustaría participar en procesos de evaluación del servicio recibido?
                            si respondió que sí, es importante hacerle saber que es probable que alguien de Glasswing en el futuro
                            se comunique para pedirle su opinión sobre la calidad del servicio recibido.') }}
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-forms.input-radio type="radio" wire:model="form.participar_proceso_evaluacion"
                                            id="form.participar_proceso_evaluacion_1"
                                            x-on:change="recontacto = true"
                                            name="form.participar_proceso_evaluacion" type="radio" value="1" />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <x-input-label class="sm:text-lg" for="form.participar_proceso_evaluacion_1">
                                            Si
                                        </x-input-label>
                                    </div>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-forms.input-radio type="radio" wire:model="form.participar_proceso_evaluacion"
                                            id="form.participar_proceso_evaluacion_0"
                                            x-on:change="recontacto = false"
                                            name="form.participar_proceso_evaluacion" type="radio" value="0" />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <x-input-label class="sm:text-lg" for="form.participar_proceso_evaluacion_0">
                                            No
                                        </x-input-label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" x-show="recontacto">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.telefono">
                            {{ __('Número de contacto telefonico:') }}
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model="form.telefono" id="form.telefono" name="form.telefono"
                                type="tel" placeholder="55555555" maxlength="{{ $form->telephone_length }}"
                                @class(['h-12 sm:text-lg', 'block w-full mt-1' ])/>
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg" for="form.email">
                            {{ __('Si posee correo electronico, indique:') }}
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model="form.email" id="form.email" name="form.email"
                                type="email" placeholder="ejemplo@mail.com" @class(['h-12 sm:text-lg', 'block w-full mt-1']) />
                        </div>
                    </div>
                </div>
                {{-- END - PARTE 7: RECONTACTO  --}}

                <div class="py-8 text-lg text-center center">
                    <strong>Fin del formulario ¡Muchas gracias!</strong>
                </div>

                {{-- Clean form --}}
                <a id="clean-form" x-on:click="cleanForm" class="invisible">
                    Limpiar formulario
                </a>
            </div>
        </div>

        @if ($form->mode != 'view')
        <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
            <button type="submit"
                class="relative w-full px-8 py-3 font-medium text-white bg-purple-600 rounded-lg text-uppercase disabled:cursor-not-allowed disabled:opacity-75 hover:bg-purple-500">
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
        @endif
    </form>


    <x-notifications.modal-confirmacion-finalizar>
        <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">¡Proceso finalizado!</h3>
        <div class="mt-2">
            <p class="text-lg text-gray-500">
                Gracias {{ $form->nombres.' '.$form->apellidos }} por completar el proceso, su código de
                confirmación es: <span class="font-semibold">{{ $form->codigo_confirmacion }}</span>
            </p>
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
</div>

@script
<script>
    Alpine.data('formIntervencion', () => ({
        compartir_informacion: false,
        protocolo_sanamente: false,
        primeros_auxilios_psicologicos: false,
        apoyo_psicosocial: false,
        referencias: false,
        referencias_titulo: false,
        recontacto: false,
        tiempo_intervencion: false,

        persona_referida: false,
        persona_referida_opcion: false,
        persona_referida_procesos: false,

        referencia_adicional: false,

        pauso_protocolo: false,
        pauso_protocolo_otros: false,
        pauso_protocolo_tiempo: false,

        razon: false,
        razon_otros: false,

        procesos: false,
        procesos_otros: false,

        tipoIntervencionDropdown(event) {
            const value = event.target.dataset.value;
            const checked = event.target.checked;
            const selected = $el.querySelectorAll("[name='form.tipo_intervencion_id']:checked");
            const intervenciones = $el.querySelectorAll("[name='form.tipo_intervencion_id']");

            if (selected.length) {
                if ($el.querySelector(".tipo-intervencion-error")) {
                    $el.querySelector(".tipo-intervencion-error").remove();
                }
            }
            else {
                this.hideAllModules();
            }


            if (value.includes("Referencia") && checked) {
                intervenciones.forEach(element => {
                    if (element.dataset.value.includes("Protocolo SanaMente") && element.checked) {
                        element.click();
                    }

                    if (element.dataset.value.includes("Primeros Auxilios") && element.checked) {
                        element.click();
                    }

                    if (element.dataset.value.includes("Apoyo psicosocial") && element.checked) {
                        element.click();
                    }
                });

                this.hideAllModules();

                this.referencias = true;
                this.referencias_titulo = true;
                this.persona_referida = true;
                this.persona_referida_procesos = true;
            }
            else {
                this.hideAllModules();

                intervenciones.forEach(element => {
                    if (element.dataset.value.includes("Referencia") && element.checked) {
                        element.click();
                    }

                    if (element.dataset.value.includes("Protocolo SanaMente") && element.checked) {
                        this.protocolo_sanamente = true;
                        this.tiempo_intervencion = true;
                        this.persona_referida = true;
                        this.persona_referida_opcion = true;
                    }

                    if (element.dataset.value.includes("Primeros Auxilios") && element.checked) {
                        this.primeros_auxilios_psicologicos = true;
                        this.tiempo_intervencion = true;
                        this.persona_referida = true;
                        this.persona_referida_opcion = true;
                    }

                    if (element.dataset.value.includes("Apoyo psicosocial") && element.checked) {
                        this.apoyo_psicosocial = true;
                        this.tiempo_intervencion = true;
                        this.persona_referida = true;
                        this.persona_referida_opcion = true;
                    }
                });

                if ($wire.form.mode === 'edit') {
                    if ($wire.form.persona_referida == 1) {
                        this.persona_referida_procesos = true;
                    }

                    if ($wire.form.participar_proceso_evaluacion == 1) {
                        this.recontacto = true;
                    }

                    this.pausoProtocoloCallback();
                    this.razonIntervaloCallback();
                    this.procesosCallback();
                }
            }
        },

        pausoProtocoloDropdown(event) {
            const selectedOption = event.target.options[event.target.selectedIndex];

            if (selectedOption.text.includes("Otro")) {
                this.pauso_protocolo_otros = true;
                this.pauso_protocolo_tiempo = true;
            }
            else if (selectedOption.text.includes("Interrupción por proceso de la sede")) {
                this.pauso_protocolo_tiempo = true;
                this.pauso_protocolo_otros = false;
            }
            else {
                this.pauso_protocolo_otros = false;
                this.pauso_protocolo_tiempo = false;
            }

            if (this.pauso_protocolo_otros) {
                setTimeout(() => $el.querySelector('[name="form.pauso_protocolo_otros"]').focus(), 200);
            }
        },

        razonDropdown(event) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            this.razon_otros = selectedOption.text.includes("Otro");

            if (this.razon_otros) {
                setTimeout(() => $el.querySelector('[name="form.razon_otro"]').focus(), 200);
            }
        },

        procesosOptions(event) {
            const procesos = $el.querySelectorAll("[name='form.proceso_id']");

            procesos.forEach(element => {
                const value = element.dataset.value;
                const isChecked = element.checked;
                this.procesos_otros = value.includes("Otro") && isChecked;
            });
        },

        cleanForm() {
            if ($wire.form.mode === 'create') {
                this.hideAllModules();
                this.compartir_informacion = false;
            }
        },

        hideAllModules() {
            this.protocolo_sanamente = false;
            this.primeros_auxilios_psicologicos = false;
            this.apoyo_psicosocial = false;
            this.referencias = false;
            this.referencias_titulo = false;
            this.tiempo_intervencion = false;
            this.recontacto = false;


            this.referencia_adicional = false;
            this.pauso_protocolo = false;
            this.pauso_protocolo_otros = false;
            this.pauso_protocolo_tiempo = false;
            this.razon = false;
            this.razon_otros = false;
            this.procesos = false;
            this.procesos_otros = false;


            this.persona_referida = false;
            this.persona_referida_opcion = false;
            this.persona_referida_procesos = false;


            if ($wire.form.mode === 'create') {
                $wire.form.tipo_otra_intervencion_id = [];
                $wire.form.tipo_psicoeducacion_id = [];
                $wire.form.estrategia_id = [];
                $wire.form.proceso_id = [];
                $wire.form.total_intervencion = '0m';
                $wire.form.razon_intervencion_id = null;
                $wire.form.pauso_protocolo = null;
                $wire.form.pauso_protocolo_id = null;
                $wire.form.inicio_intervencion = null;
                $wire.form.fin_intervencion = null;
                $wire.form.pauso_intervencion = null;

                // Reset para las propiedades del form.
                const event = new Event('change');
                const time = document.querySelectorAll("[type='time']");

                time.forEach(element => {
                    element.value = null;
                    element.dispatchEvent(event);
                });

                // Reset para pauso protocolo
                const pauso = document.querySelectorAll("[name='form.pauso_protocolo']");
                pauso.forEach(element => element.checked = false);

                // Reset para persona referida
                const referido = document.querySelectorAll("[name='form.persona_referida']");
                referido.forEach(element => element.checked = false);
            }
        },

        pausoProtocoloCallback() {
            if ($wire.form.pauso_protocolo_id) {
                const pausoDropdown = $el.querySelector('select[id="form.pauso_protocolo_id"]');

                Object.values($wire.form.tipo_intervencion_id).forEach(id => {
                    const element = $el.querySelector(`[name="form.tipo_intervencion_id"][value="${id}"]`);

                    if (element.dataset.value.includes("Protocolo SanaMente")) {
                        this.pauso_protocolo = true;
                    }
                });

                if (pausoDropdown) {
                    const pausoOption = pausoDropdown.options[$wire.form.pauso_protocolo_id];

                    if (pausoOption) {
                        if (pausoOption.text.includes("Otro")) {
                            this.pauso_protocolo_otros = true;
                            this.pauso_protocolo_tiempo = true;
                        }
                        else if (pausoOption.text.includes("Interrupción por proceso de la sede")) {
                            this.pauso_protocolo_tiempo = true;
                            this.pauso_protocolo_otros = false;
                        }
                        else {
                            this.pauso_protocolo_otros = false;
                            this.pauso_protocolo_tiempo = false;
                        }
                    }
                }
            }
        },

        razonIntervaloCallback() {
            if ($wire.form.razon_intervencion_id) {
                const razonDropdown = $el.querySelector('select[id="form.razon_intervencion_id"]');

                if (razonDropdown) {
                    const razonOption = razonDropdown.options[$wire.form.razon_intervencion_id];

                    if (razonOption) {
                        if (razonOption.text.includes("Otro")) {
                            this.razon_otros = true;

                            setTimeout(() => {
                                $el.querySelector('[x-show="razon_otros"]')?.hasAttribute('style')
                                    && $el.querySelector('[x-show="razon_otros"]')?.removeAttribute('style');
                            }, 300);
                        }
                    }
                }
            }
        },

        procesosCallback() {
            if ($wire.form.proceso_id) {
                Object.values($wire.form.proceso_id).forEach(id => {
                    const element = $el.querySelector(`[name="form.proceso_id"][value="${id}"]`);

                    if (element.dataset.value.includes("Otro")) {
                        this.procesos_otros = true;

                        setTimeout(() => {
                            $el.querySelector('[x-show="procesos_otros"]')?.hasAttribute('style')
                                && $el.querySelector('[x-show="procesos_otros"]')?.removeAttribute('style');
                        }, 300);
                    }
                });
            }
        },

        init() {
            if (Object.keys($wire.form.tipo_intervencion_id).length) {
                // Cargar ciudad y sede
                setTimeout(() => $wire.dispatch('load-intervencion-ciudad-sede'), 200);

                // Mostrar datos del participante
                if ($wire.form.compartir_informacion) {
                    this.compartir_informacion = true;
                }
                else {
                    if ($wire.form.sexo == 1) {
                        $el.querySelector(`[id="form.sexo_3"]`).checked = true;
                    }
                    else {
                        $el.querySelector(`[id="form.sexo_4"]`).checked = true;
                    }
                }

                // Recontacto
                if ($wire.form.participar_proceso_evaluacion == 1) {
                    this.recontacto = true;
                }

                // Tipo de intervencion
                Object.values($wire.form.tipo_intervencion_id).forEach(id => {
                    const element = $el.querySelector(`[name="form.tipo_intervencion_id"][value="${id}"]`);

                    if (element.dataset.value.includes("Referencia")) {
                        this.referencias = true;
                        this.referencias_titulo = true;
                        this.persona_referida = true;
                        this.persona_referida_procesos = true;
                    }
                    else {
                        if (element.dataset.value.includes("Protocolo SanaMente")) {
                            this.protocolo_sanamente = true;
                            this.tiempo_intervencion = true;
                            this.persona_referida = true;
                            this.persona_referida_opcion = true;
                        }

                        if (element.dataset.value.includes("Primeros Auxilios")) {
                            this.primeros_auxilios_psicologicos = true;
                            this.tiempo_intervencion = true;
                            this.persona_referida = true;
                            this.persona_referida_opcion = true;
                        }

                        if (element.dataset.value.includes("Apoyo psicosocial")) {
                            this.apoyo_psicosocial = true;
                            this.tiempo_intervencion = true;
                            this.persona_referida = true;
                            this.persona_referida_opcion = true;
                        }
                    }
                });

                // Persona referida
                if ($wire.form.persona_referida == 1) {
                    this.persona_referida_procesos = true;
                }

                // Pause protocolo
                this.pausoProtocoloCallback();

                // Razon de intervencion
                this.razonIntervaloCallback();

                // Procesos
                this.procesosCallback();
            }
        },
    }));
</script>
@endscript

@script
<script>
    document.addEventListener('livewire:navigated', function () {
        // Initialize Choices.js for the second dropdown
        const choicesOptions = {
            shouldSort: false,
            placeholderValue: 'Seleccione una sede',
            itemSelectText: 'Seleccione',
            noChoicesText: 'Seleccione un Municipio',
        };

        let selectSede = new Choices($wire.$el.querySelector('[data-choice]'), choicesOptions);

        // Listen for changes in Livewire and update the second dropdown accordingly
        Livewire.on('refresh-choices', subcategories => {
            let subcategoryElement = document.getElementById('form.sede_id');

            subcategoryElement.innerHTML = '';

            if (subcategories[0].length == 0) {
                subcategoryElement.innerHTML = '<option value="">Seleccione una sede</option>';
            }

            for (const [key, value] of Object.entries(subcategories[0])) {
                let newOption = new Option(value, key);
                subcategoryElement.add(newOption);
            }

            // Re-initialize Choices.js with the new options
            selectSede.refresh();
        });

        Livewire.on('reset-intervencion-form', () => {
            // Reset time fields
            const cleanForm = document.querySelector("#clean-form");

            if (cleanForm) {
                const eventClick = new Event('click');
                cleanForm.dispatchEvent(eventClick);
            }
        });

        Livewire.on('load-intervencion-ciudad-sede', () => {
            if ($wire.form.ciudad_id) {
                const ciudad_id = document.getElementById('form.ciudad_id');

                if (ciudad_id) {
                    setTimeout(() => ciudad_id.value = $wire.form.ciudad_id.toString(), 200);
                }
            }

            if ($wire.form.sede_id) {
                selectSede.setChoiceByValue($wire.form.sede_id.toString());
            }
        });
    });
</script>
@endscript
