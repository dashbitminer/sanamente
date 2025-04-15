<div class="px-4 sm:px-0">

    <div class="flex flex-col justify-between items-center sm:flex-row">
        <div class="flex mb-4 w-full sm:w-1/2 sm:mb-0">
            <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-auto sm:w-4/5">
        </div>
        <div class="flex justify-end w-full sm:w-1/2">
            <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-auto sm:w-4/5">
        </div>
    </div>

    <h1 class="mt-10 mb-10 text-4xl font-bold text-center">Formulario de inscripción de participantes - {{ $pais->nombre }}</h1>
    <p class="mt-4 text-lg leading-7 text-justify text-gray-700">{{ $labels['bienvenido'] }}</p>

    @auth
        <div class="mt-10">
            <a href="{{ route('admin.inscripcion.index') }}"
                class="block px-8 py-3 w-full font-medium text-white rounded-lg bg-azul-glasswing text-uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline-block mr-2 w-5 h-5 size-5">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                </svg>
                Volver al visualizador
            </a>
        </div>
    @endauth

    <form wire:submit='save'>
        <div class="space-y-12">
            <div x-data="formInscripcion" class="pt-12 pb-12 border-b border-gray-900/10">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('Seleccione el sector de su institución u organización:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-forms.single-select name="form.institucion_organizacion_id" wire:model.live='form.institucion_organizacion_id' id="form.institucion_organizacion_id"
                                :options="$institucionOrganizaciones" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.institucion_organizacion_id')
                                ]) />
                            <x-input-error :messages="$errors->get('form.institucion_organizacion_id')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('Escribe tu fecha de nacimiento:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.live.debounce.500ms="form.fecha_nacimiento" id="form.fecha_nacimiento"
                                wire:keydown.enter="$set('form.fecha_nacimiento', $event.target.value)"
                                name="form.fecha_nacimiento"
                                type="date" max="{{ $form->fecha_nacimiento_max }}"
                                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.fecha_nacimiento')
                                ]) />
                            <x-input-error :messages="$errors->get('form.fecha_nacimiento')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div x-cloak x-show="$wire.form.fecha_nacimiento_validacion == true && $wire.form.institucion_organizacion_id != null">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('DATOS DE IDENTIFICACIÓN') }}</h3>
                            <p class="text-lg leading-7 text-justify text-gray-700">
                                Las preguntas a continuación deberán ser completadas con tu información como participante de las actividades de Glasswing.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.nombres">
                                {{ __('Escribe tus nombres completos:') }}
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
                                {{ __('Escribe tus apellidos completos:') }}
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

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.sexo">
                                {{ __('Selecciona tu sexo según registro nacional:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.sexo_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.sexo"
                                            id="form.sexo_1"
                                            name="form.sexo" type="radio" value="1" />Hombre
                                    </x-input-label>
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.sexo_2">
                                        <x-forms.input-radio type="radio" wire:model.live="form.sexo"
                                            id="form.sexo_2"
                                            name="form.sexo" type="radio" value="2" />Mujer
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.sexo')" class="mt-2" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.departamento_id">
                                {{ $labels['departamento'] }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-forms.single-select name="form.departamento_id" wire:model.live='form.departamento_id' id="form.departamento_id"
                                    :options="$departamentos" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.departamento_id')
                                    ]) />
                                <x-input-error :messages="$errors->get('form.departamento_id')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.ciudad_id">
                                {{ $labels['minicipio'] }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <flux:select variant="listbox" searchable placeholder="Selecciona una opción"
                                name="form.ciudad_id" wire:model.live='form.ciudad_id' id="form.ciudad_id"
                                @class(['flux-custom-select', 'border-2 border-red-500' => $errors->has('form.ciudad_id')])>
                                    <x-slot name="search">
                                        <flux:select.search class="px-4" placeholder="Buscar..." />
                                    </x-slot>

                                    @foreach ($form->ciudades as $key => $value)
                                        <flux:option value="{{ $key }}">{{ $value }}</flux:option>
                                    @endforeach
                                </flux:select>
                                <x-input-error :messages="$errors->get('form.ciudad_id')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.sede_id">
                                {{ __('Selecciona tu nacionalidad:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex gap-6">
                                    <x-input-label class="flex gap-2 items-center h-12 sm:text-lg">
                                        <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad"
                                                id="form.nacionalidad_1"
                                                name="form.nacionalidad" type="radio" value="1" class="h-12 sm:text-lg"/>
                                        {{ $labels['nacionalidad'] }}
                                    </x-input-label>
                                    <x-input-label class="flex gap-2 items-center h-12 sm:text-lg">
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
                                        @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                        'border-2 border-red-500' => $errors->has('form.documento_identidad')
                                        ]) />
                                @else
                                    @if ($pais->nombre == 'México' && $form->nacionalidad == 1)
                                        <x-text-input wire:model="form.documento_identidad"
                                            id="form.documento_identidad"
                                            name="form.documento_identidad"
                                            type="text"
                                            minlength="10" maxlength="18"
                                            @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                            'border-2 border-red-500' => $errors->has('form.documento_identidad')
                                            ]) />
                                    @else
                                        <x-text-input wire:model="form.documento_identidad"
                                            id="form.documento_identidad"
                                            name="form.documento_identidad"
                                            type="text"
                                            @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                            'border-2 border-red-500' => $errors->has('form.documento_identidad')
                                            ]) />
                                    @endif
                                @endif
                                <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.telefono">
                                {{ __('Escribe tu número de teléfono:') }}
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model="form.telefono" id="form.telefono" name="form.telefono"
                                    type="tel" x-mask="{{ $form->telephone_mask }}" maxlength="{{ $form->telephone_length }}"
                                    @class(['h-12 sm:text-lg', 'block w-full mt-1' ])/>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.email">
                                {{ __('Escribe tu correo electrónico:') }}
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model="form.email" id="form.email" name="form.email"
                                    type="email" @class(['h-12 sm:text-lg', 'block w-full mt-1']) />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.estudiando">
                                {{ __('¿Te encuentras actualmente estudiando?') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.estudiando_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.estudiando"
                                            id="form.estudiando_1" data-value="Si"
                                            name="form.estudiando" type="radio" value="1" />Si
                                    </x-input-label>
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.estudiando_2">
                                        <x-forms.input-radio type="radio" wire:model.live="form.estudiando"
                                            id="form.estudiando_2" data-value="No"
                                            name="form.estudiando" type="radio" value="2" />No
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.estudiando')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>

                    {{-- Grado Actual --}}
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6" x-cloak x-show="$wire.form.estudiando == 1">
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.grado_id">
                                {{ __('Selecciona tu grado actual:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-forms.single-select name="form.grado_id" wire:model.live='form.grado_id' id="form.grado_id"
                                    :options="$grados" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.grado_id')
                                    ]) />
                                <x-input-error :messages="$errors->get('form.grado_id')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>

                        @if ($pais->slug !== 'colombia')
                            <div class="sm:col-span-3" x-cloak x-show="$wire.form.gradoSuperior == false">
                                <x-input-label class="sm:text-lg" for="form.grado_seccion_id">
                                    {{ __('Selecciona tu sección:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.grado_seccion_id" wire:model.live='form.grado_seccion_id' id="form.grado_seccion_id"
                                        :options="$gradoSecciones" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.grado_seccion_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.grado_seccion_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>

                            <div class="sm:col-span-3" x-cloak x-show="$wire.form.gradoSuperior == false">
                                <x-input-label class="sm:text-lg" for="form.grado_jornada_id">
                                    {{ __('Selecciona el turno o jornada en la que estudias:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.grado_jornada_id" wire:model.live='form.grado_jornada_id' id="form.grado_jornada_id"
                                        :options="$gradoJornadas" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.grado_jornada_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.grado_jornada_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- Fin Grado Actual --}}

                    {{-- Grado Alcanzado --}}
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6" x-cloak x-show="$wire.form.estudiando == 2">
                        <div class="col-span-full">
                            <x-input-label class="sm:text-lg" for="form.grado_alcanzado_id">
                                {{ __('Último grado alcanzado:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-forms.single-select name="form.grado_alcanzado_id" wire:model.live='form.grado_alcanzado_id' id="form.grado_alcanzado_id"
                                    :options="$gradoAlcanzados" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.grado_alcanzado_id')
                                    ]) />
                                <x-input-error :messages="$errors->get('form.grado_alcanzado_id')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>
                    {{-- Grado Alcanzado --}}

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.discapacidad">
                                {{ __('¿Posees alguna discapacidad?') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.discapacidad_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.discapacidad"
                                            id="form.discapacidad_1" data-value="Si"
                                            name="form.discapacidad" type="radio" value="1" />Si
                                    </x-input-label>
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.discapacidad_2">
                                        <x-forms.input-radio type="radio" wire:model.live="form.discapacidad"
                                            id="form.discapacidad_2" data-value="No"
                                            name="form.discapacidad" type="radio" value="2" />No
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.discapacidad')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <div x-show="$wire.form.discapacidad == 1">
                                <x-input-label class="sm:text-lg" for="form.inscripcion_discapacidad_id">
                                    {{ __('¿Cual?') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="px-4 py-3">
                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                        @foreach ($discapacidades as $key => $value)
                                        <div class="flex relative gap-x-3">
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
                                            <div class="leading-6 sm:text-lg">
                                                <label for="inscripcion-discapacidad-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('form.discapacidadesSelect')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.ha_participado_actividades_glasswing">
                                {{ __('¿Has participado en años anteriores en actividades de Glasswing?') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.ha_participado_actividades_glasswing_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.ha_participado_actividades_glasswing"
                                            id="form.ha_participado_actividades_glasswing_1" data-value="Si"
                                            name="form.ha_participado_actividades_glasswing" type="radio" value="1" />Si
                                    </x-input-label>
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.ha_participado_actividades_glasswing_2">
                                        <x-forms.input-radio type="radio" wire:model.live="form.ha_participado_actividades_glasswing"
                                            id="form.ha_participado_actividades_glasswing_2" data-value="No"
                                            name="form.ha_participado_actividades_glasswing" type="radio" value="2" />No
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.ha_participado_actividades_glasswing')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.perfil_identificas">
                                {{ __('Selecciona el perfil con el que te identificas:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <br>
                                <x-forms.single-select name="form.perfil_identificas" wire:model.live='form.perfil_identificas' id="form.perfil_identificas"
                                    :options="$perfilIdentificas" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_identificas')
                                    ]) />
                                <x-input-error :messages="$errors->get('form.perfil_identificas')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6" x-cloak x-show="$wire.form.hasPerfilIdentificas == true">
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.perfil_institucional_id">
                                {{ __('Selecciona tu tipo de personal institucional:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-forms.single-select name="form.perfil_institucional_id" wire:model.live='form.perfil_institucional_id' id="form.perfil_institucional_id"
                                    :options="$perfilInstitucionales" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_institucional_id')
                                    ]) />
                                <x-input-error :messages="$errors->get('form.perfil_institucional_id')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>

                        @if ($form->institucionalEducacionSelect)
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.perfil_institucional_educacion_id">
                                    {{ __('Selecciona tu perfil:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.perfil_institucional_educacion_id" wire:model.live='form.perfil_institucional_educacion_id' id="form.perfil_institucional_educacion_id"
                                        :options="$form->institucionalEducacionSelect" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_institucional_educacion_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.perfil_institucional_educacion_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        @endif

                        @if ($form->rangoOrganizacionesSelect)
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.perfil_rango_organizacion_id">
                                    {{ __('Selecciona tu perfil:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.perfil_rango_organizacion_id" wire:model.live='form.perfil_rango_organizacion_id' id="form.perfil_rango_organizacion_id"
                                        :options="$form->rangoOrganizacionesSelect" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_rango_organizacion_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.perfil_rango_organizacion_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        @endif

                        @if ($form->institucionalPoliciaSelect)
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.perfil_institucional_policia_id">
                                    {{ __('Selecciona tu perfil:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.perfil_institucional_policia_id" wire:model.live='form.perfil_institucional_policia_id' id="form.perfil_institucional_policia_id"
                                        :options="$form->institucionalPoliciaSelect" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_institucional_policia_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.perfil_institucional_policia_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        @endif

                        @if ($form->rangosSelect)
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.perfil_rango_id">
                                    {{ __('Selecciona tu rango/categoría:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.perfil_rango_id" wire:model.live='form.perfil_rango_id' id="form.perfil_rango_id"
                                        :options="$form->rangosSelect" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_rango_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.perfil_rango_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        @endif

                        @if ($form->rangoSaludSelect)
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.perfil_rango_salud_id">
                                    {{ __('Selecciona tu perfil:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.perfil_rango_salud_id" wire:model.live='form.perfil_rango_salud_id' id="form.perfil_rango_salud_id"
                                        :options="$form->rangoSaludSelect" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_rango_salud_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.perfil_rango_salud_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        @endif

                        @if ($form->personalSaludSelect)
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.perfil_personal_salud_id">
                                    {{ __('Selecciona tu perfil de personal de salud:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.perfil_personal_salud_id" wire:model.live='form.perfil_personal_salud_id' id="form.perfil_personal_salud_id"
                                        :options="$form->personalSaludSelect" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.perfil_personal_salud_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.perfil_personal_salud_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('DATOS DE SEDE') }}</h3>
                        </div>

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.pertenece_departamento_id">
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
                            <x-input-label class="sm:text-lg" for="form.pertenece_ciudad_id">
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
                            <x-input-label class="sm:text-lg" for="form.pertenece_sede_id">
                                {{ __('Selecciona la escuela/sede a la que pertenece') }}
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

                    @if ($pais->slug == 'honduras')
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 mt-10 sm:grid-cols-6" x-cloak x-show="$wire.is_dgdp">
                            <div class="col-span-full pt-6 pb-4">
                                <p class="text-lg leading-7 text-center text-gray-700">
                                    <strong>Datos del centro educativo donde labora (Información requerida por la DGDP)</strong>
                                </p>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.centro_educativo">
                                    {{ __('Nombre del centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-text-input wire:model.blur="form.centro_educativo" id="form.centro_educativo" name="form.centro_educativo"
                                        type="text" placeholder="Centro Educativo"
                                        @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.centro_educativo')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.centro_educativo')" class="mt-2" />
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.centro_educativo_tipo_id">
                                    {{ __('Tipo de centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.centro_educativo_tipo_id" wire:model.live='form.centro_educativo_tipo_id' id="form.centro_educativo_tipo_id"
                                        :options="$centroEducativoTipos" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.centro_educativo_tipo_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.centro_educativo_tipo_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.centro_educativo_cargo_id">
                                    {{ __("Cargo que tiene en el centro educativo donde labora:") }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <br>
                                    <x-forms.single-select name="form.centro_educativo_cargo_id" wire:model.live='form.centro_educativo_cargo_id' id="form.centro_educativo_cargo_id"
                                        :options="$centroEducativoCargos" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.centro_educativo_cargo_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.centro_educativo_cargo_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.labora_departamento_id">
                                    {{ __('Departamento donde esta ubicado el centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.labora_departamento_id" wire:model.live='form.labora_departamento_id' id="form.labora_departamento_id"
                                        :options="$laboraDepartamento" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.labora_departamento_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.labora_departamento_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.labora_municipio_id">
                                    {{ __('Municipio donde esta ubicado el centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.labora_municipio_id" wire:model.live='form.labora_municipio_id' id="form.labora_municipio_id"
                                        :options="$form->laboraCiudades" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.labora_municipio_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.labora_municipio_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.labora_aldea_id">
                                    {{ __('Aldea donde esta ubicado el centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-text-input wire:model.blur="form.labora_aldea_id" id="form.labora_aldea_id" name="form.labora_aldea_id"
                                        type="text"
                                        @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.labora_aldea_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.labora_aldea_id')" class="mt-2" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.labora_caserio_id">
                                    {{ __('Caserío donde esta ubicado el centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-text-input wire:model.blur="form.labora_caserio_id" id="form.labora_caserio_id" name="form.labora_caserio_id"
                                        type="text"
                                        @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.labora_caserio_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.labora_caserio_id')" class="mt-2" />
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.labora_codigo_sace">
                                    {{ __('Código SACE del donde esta ubicado el centro educativo donde labora') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-text-input wire:model.blur="form.labora_codigo_sace" id="form.labora_codigo_sace" name="form.labora_codigo_sace"
                                        type="text" placeholder="Código SACE"
                                        @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.labora_codigo_sace')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.labora_codigo_sace')" class="mt-2" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.centro_educativo_jornada">
                                    Jornada que atiende en el centro educativo donde<br>labora:
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <x-forms.single-select name="form.centro_educativo_jornada" wire:model.live='form.centro_educativo_jornada' id="form.centro_educativo_jornada"
                                        :options="$centroEducativoJornadas" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.centro_educativo_jornada')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.centro_educativo_jornada')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.centro_educativo_nivel_id">
                                    {{ __('Nivel que atiende en el centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <br>
                                    <x-forms.single-select name="form.centro_educativo_nivel_id" wire:model.live='form.centro_educativo_nivel_id' id="form.centro_educativo_nivel_id"
                                        :options="$centroEducativoNiveles" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.centro_educativo_nivel_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.centro_educativo_nivel_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.centro_educativo_ciclo_id">
                                    {{ __('Ciclo que atiende en el centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="mt-2">
                                    <br>
                                    <x-forms.single-select name="form.centro_educativo_ciclo_id" wire:model.live='form.centro_educativo_ciclo_id' id="form.centro_educativo_ciclo_id"
                                        :options="$centroEducativoCiclos" selected="Selecciona una opción" @class([ 'h-12 sm:text-lg',
                                        'block w-full mt-1','border-2 border-red-500' => $errors->has('form.centro_educativo_ciclo_id')
                                        ]) />
                                    <x-input-error :messages="$errors->get('form.centro_educativo_ciclo_id')" class="mt-2" aria-live="assertive" />
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.centro_educativo_zona_geografica">
                                    {{ __('Zona Geográfica donde esta ubicado el centro educativo donde labora:') }}
                                    <x-required-label />
                                </x-input-label>
                                <div class="px-4 py-3">
                                    <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                        <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.centro_educativo_zona_geografica_1">
                                            <x-forms.input-radio type="radio" wire:model.live="form.centro_educativo_zona_geografica"
                                                id="form.centro_educativo_zona_geografica_1"
                                                name="form.centro_educativo_zona_geografica" type="radio" value="1" />Urbana
                                        </x-input-label>
                                        <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.centro_educativo_zona_geografica_2">
                                            <x-forms.input-radio type="radio" wire:model.live="form.centro_educativo_zona_geografica"
                                                id="form.centro_educativo_zona_geografica_2"
                                                name="form.centro_educativo_zona_geografica" type="radio" value="2" />Rural
                                        </x-input-label>
                                    </div>
                                    <x-input-error :messages="$errors->get('form.centro_educativo_zona_geografica')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- AUTORIZACIÓN DE INFORMACIÓN --}}
                    <div class="grid grid-cols-1 gap-y-2 gap-x-6 mt-10 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('AUTORIZACIÓN DE INFORMACIÓN') }}</h3>
                        </div>
                        <div class="col-span-full">
                            <p class="text-lg leading-7 text-justify text-gray-700">
                                {{ $labels['autorizacion1'] }}
                            </p>
                            <div class="px-4 py-3">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                    <div class="flex relative gap-x-3">
                                        <div class="flex items-center h-6">
                                            <x-text-input type="checkbox"
                                                wire:model="form.autorizacion_informacion"
                                                value="1"
                                                class="mt-2 w-6 h-6 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                                id="form.autorizacion_informacion"
                                                name="form.autorizacion_informacion"
                                            />
                                        </div>
                                        <div class="leading-6 sm:text-lg">
                                            <label for="form.autorizacion_informacion" class="font-bold sm:text-lg">
                                                {{ $labels['autorizacion2'] }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('form.autorizacion_informacion')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    {{-- FIN AUTORIZACIÓN DE INFORMACIÓN --}}

                    {{-- DERECHOS DE USO DE IMAGEN Y VOZ --}}
                    <div class="grid grid-cols-1 gap-y-2 gap-x-6 mt-7 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('DERECHOS DE USO DE IMAGEN Y VOZ') }}</h3>
                        </div>
                        <div class="col-span-full">
                            <p class="text-lg leading-7 text-justify text-gray-700">
                                Solicitamos la autorización para la toma de fotografías y videos en grupo y/o individuales de carácter general. La autorización admite lo siguiente:
                            </p>
                            <ul class="mt-4 text-lg leading-7 list-disc list-inside text-justify text-gray-700">
                                <li>Uso exclusivo en plataformas institucionales y rendición de socios de Glasswing, las cuales podrán ser compartidas y publicadas por nuestros socios (cooperación internacional, empresas, organizaciones o centros educativos).</li>
                                <li>Autorización para uso de fotografías o videos en medios de comunicación, siempre ligados al trabajo de Glasswing o socios.</li>
                                <li>Autorización con una vigencia de uso máximo de cinco años, salvo para imágenes en reportes o aniversarios de la organización.</li>
                                <li>Uso de voz e imagen para eventos o presentaciones públicas.</li>
                            </ul>
                            <p class="mt-4 text-lg leading-7 text-justify text-gray-700">
                                Ninguna fotografía, video se podrá utilizar para fines políticos, religiosos o personales por ningún miembro de nuestra organización o externos a ella. La autorización para el uso de voz e imagen no es un requisito para participar en el programa.
                            </p>
                            <div class="px-4 py-3">
                                <div class="flex flex-col gap-4">
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.derechos_image_voz_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.derechos_image_voz"
                                            id="form.derechos_image_voz_1"
                                            name="form.derechos_image_voz" type="radio" value="1" />
                                            <span class="font-bold">Brindo autorización de mi voz e imagen</span>
                                    </x-input-label>
                                    <x-input-label class="flex gap-4 items-center sm:text-lg" for="form.derechos_image_voz_0">
                                        <x-forms.input-radio type="radio" wire:model.live="form.derechos_image_voz"
                                            id="form.derechos_image_voz_0"
                                            name="form.derechos_image_voz" type="radio" value="0" />
                                            <span class="font-bold">No brindo autorización de mi voz e imagen</span>
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.derechos_image_voz')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>
                    {{-- FIN DERECHOS DE USO DE IMAGEN Y VOZ --}}

                    {{-- CONSENTIMIENTO DE PARTICIPACIÓN --}}
                    <div class="grid grid-cols-1 gap-y-2 gap-x-6 mt-7 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('CONSENTIMIENTO DE PARTICIPACIÓN') }}</h3>
                        </div>
                        <div class="col-span-full">
                            <p class="text-lg leading-7 text-justify text-gray-700">
                                Yo: <strong class="text-indigo-600">{{ $form->nombres.' '.$form->apellidos }}</strong>,
                                de <strong class="text-indigo-600">{{ \Carbon\Carbon::parse($form->fecha_nacimiento)->age }}</strong> años de edad,
                                he sido informada/informado de las actividades que realiza Glasswing International, por tanto,
                                <select wire:model.live="form.consentimiento" class="inline rounded-md border-gray-300 shadow-sm sm:leading-6 focus:border-indigo-500 focus:ring-indigo-500 sm:text-lg">
                                    <option value="0"></option>
                                    <option value="1">Acepto</option>
                                </select> PARTICIPAR DE FORMA VOLUNTARIA en el programa. Comprendo que Glasswing International posee protocolos
                                que protegen mi participación.
                            </p>
                            <x-input-error :messages="$errors->get('form.consentimiento')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    {{-- FIN CONSENTIMIENTO DE PARTICIPACIÓN --}}
                </div>
            </div>
        </div>

        <div class="flex gap-x-6 justify-end items-center px-4 py-4 border-t border-gray-900/10 sm:px-8" x-cloak x-show="$wire.form.fecha_nacimiento_validacion == true && $wire.form.institucion_organizacion_id != null">
            <button type="submit"
                class="relative px-8 py-3 w-full font-medium text-white bg-purple-600 rounded-lg text-uppercase disabled:cursor-not-allowed disabled:opacity-75 hover:bg-purple-500">
                GUARDAR
                <div wire:loading.flex wire:target="save"
                    class="flex absolute top-0 right-0 bottom-0 items-center pr-4">
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

    <x-inscripcion.modal-confirmacion-finalizar>
        <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">¡Proceso finalizado!</h3>
        <div class="mt-2">
            <p class="text-lg text-gray-500">
                Gracias <span class="font-semibold">{{ $form->fullName }}</span> por completar el proceso, su código de
                confirmación es: <span class="font-semibold">{{ $form->codigo_confirmacion }}</span>
            </p>
        </div>
    </x-inscripcion.modal-confirmacion-finalizar>

    <x-inscripcion.modal-error-notification>
        <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">¡Atención sus respuestas no han sido guardadas!</h3>
        <div class="mt-2">
            <p class="text-lg text-gray-500">
                Por favor comuniquese con el lider de esta actividad porque sus datos ya se encuentran en nuestras bases
                y no es necesario que vuelva a llenar el formulario
            </p>
        </div>
    </x-inscripcion.modal-error-notification>


    <!-- Error Indicator... -->
    <x-notifications.error-text-notification message="Han habido errores en el formulario" />

    <!-- Error Alert... -->
    <x-notifications.alert-error-notification>
        <p class="text-sm font-medium text-red-900">¡Errores en el formulario!</p>
        <p class="mt-1 text-sm text-gray-500">Han habido problemas para guardar los cambios, corrija cualquier
            error en el formulario e intente nuevamente.</p>
    </x-notifications.alert-error-notification>

    <style>
        .flux-custom-select [type="button"] {
            font-size: 1.125rem;
            padding: 1.5rem 1rem;
            border-color: rgb(209 213 219 / var(--tw-border-opacity));
            color: rgb(17 24 39 / var(--tw-text-opacity));
        }

        .flux-custom-select ui-option {
            font-size: 1.125rem;
        }
    </style>
</div>

@script
<script>
    Alpine.data('formInscripcion', () => ({
        init() {
            if ($wire.form.autorizacion_informacion) {
                const autorizacion_informacion = document.getElementById('form.autorizacion_informacion');

                if (autorizacion_informacion) {
                    setTimeout(() => autorizacion_informacion.checked = true, 200);

                    setTimeout(() => $wire.dispatch('load-ciudades'), 300);
                    setTimeout(() => $wire.dispatch('load-sedes'), 300);
                }
            }
        }
    }));
</script>
@endscript

@script
<script>
    document.addEventListener('livewire:navigated', function () {
        Livewire.on('load-ciudades', () => {
            if ($wire.form.ciudad_id) {
                const ciudad_id = document.getElementById('form.ciudad_id');

                if (ciudad_id) {
                    setTimeout(() => ciudad_id.value = $wire.form.ciudad_id.toString(), 200);
                }
            }

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
    });
</script>
@endscript
