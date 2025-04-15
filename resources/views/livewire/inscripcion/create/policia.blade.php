<div class="px-4 sm:px-0">

    <div class="flex flex-col items-center justify-between sm:flex-row">
        <div class="flex w-full mb-4 sm:w-1/2 sm:mb-0">
            <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-auto sm:w-4/5">
        </div>
        <div class="flex justify-end w-full sm:w-1/2">
            <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-auto sm:w-4/5">
        </div>
    </div>

    <h1 class="mt-10 mb-10 text-4xl font-bold text-center">Formulario de inscripción de participantes PNC</h1>
    <p class="mt-4 text-lg leading-7 text-justify text-gray-700">
        ¡Hola! Te damos la bienvenida a Glasswing International. Es un agrado que quieras participar en nuestras actividades.
        A continuación, te presentamos un formulario de inscripción que debe ser llenado solamente una vez, sin importar que
        participes en uno o más clubes, formaciones, cafés comunitarios u otras actividades impartidas por Glasswing International.
        La información solicitada es para usos exclusivos de Glasswing, te aseguramos que tu información no será compartida con
        terceros sin tu autorización. Toda la información será guardada con estricta confidencialidad y nada de lo que compartas
        tendrá repercusiones sobre tu persona o tu participación en las actividades. Si tienes consultas sobre este formulario,
        puedes hacerlas sin ningún problema a la persona líder de la actividad en cualquier momento.
    </p>

    @auth
        <div class="mt-10">
            <a href="{{ route('admin.inscripcion.index') }}"
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
            <div x-data="formInscripcion" class="pt-12 pb-12 border-b border-gray-900/10">
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-input-label class="sm:text-lg">
                            {{ __('Escribe tu edad en años cumplidos:') }}
                            <x-required-label />
                        </x-input-label>
                        <div class="mt-2">
                            <x-text-input wire:model.blur="form.edad" id="form.edad" name="form.edad"
                                type="number" min="0" max="99"
                                @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.edad')
                                ]) />
                            <x-input-error :messages="$errors->get('form.edad')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div x-cloak x-show="$wire.form.fecha_nacimiento_validacion == true && $wire.form.institucion_organizacion_id != null">
                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('DATOS DE IDENTIFICACIÓN') }}</h3>
                            <p class="text-lg leading-7 text-justify text-gray-700">
                                Las preguntas a continuación deberán ser completadas con tu información como participante de las actividades de Glasswing.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.nombres">
                                {{ __('Escribe tu indicativo de nombre:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model.blur="form.nombres" id="form.nombres" name="form.nombres"
                                    type="text" placeholder="Nombres"
                                    @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres')
                                    ]) />
                                <small class="text-sm">Ejemplo: Juan</small>
                                <x-input-error :messages="$errors->get('form.nombres')" class="mt-2" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.apellidos">
                                {{ __('Escribe tu indicativo de apellidos:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model.blur="form.apellidos" id="form.apellidos" name="form.apellidos"
                                    type="text" placeholder="Apellidos"
                                    @class([ 'h-12 sm:text-lg',
                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.apellidos')
                                    ]) />
                                <small class="text-sm">Ejemplo: Pérez González</small>
                                <x-input-error :messages="$errors->get('form.apellidos')" class="mt-2" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.sede_id">
                                {{ __('Selecciona tu nacionalidad:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex gap-6">
                                    <x-input-label class="flex items-center h-12 gap-2 sm:text-lg">
                                        <x-forms.input-radio type="radio" wire:model.live="form.nacionalidad"
                                                id="form.nacionalidad_1"
                                                name="form.nacionalidad" type="radio" value="1" class="h-12 sm:text-lg"/>
                                        {{ $labels['nacionalidad'] }}
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
                            <x-input-label class="sm:text-lg" for="form.documento_identidad" x-cloak x-show="$wire.form.nacionalidad == 1">
                                Escribe los últimos 4 dígitos de tu Documento de Identidad (DUI):
                                <x-required-label />
                            </x-input-label>
                            <x-input-label class="sm:text-lg" for="form.documento_identidad" x-cloak x-show="$wire.form.nacionalidad == 2">
                                Escribe los últimos 4 dígitos de tu carnet de residencia, documento extranjero o pasaporte:
                                <x-required-label />
                            </x-input-label>
                            <div class="mt-2" x-cloak x-show="$wire.form.nacionalidad == 1 || $wire.form.nacionalidad == 2">
                                <x-text-input wire:model.blur="form.documento_identidad"
                                    id="form.documento_identidad"
                                    name="form.documento_identidad"
                                    type="text"
                                    placeholder="{{ $form->dni_placeholder }}"
                                    x-mask="{{ $form->dni_mask }}"
                                    @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                    'border-2 border-red-500' => $errors->has('form.documento_identidad')
                                    ]) />
                                <small class="text-sm" x-cloak x-show="$wire.form.nacionalidad == 1">Usar formato como el ejemplo: 0081</small>
                                <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.sexo">
                                {{ __('Selecciona tu sexo según registro nacional:') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.sexo_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.sexo"
                                            id="form.sexo_1"
                                            name="form.sexo" type="radio" value="1" />Hombre
                                    </x-input-label>
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.sexo_2">
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
                            <x-input-label class="sm:text-lg" for="form.telefono">
                                {{ __('Escribe tu número de teléfono (opcional):') }}
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model="form.telefono" id="form.telefono" name="form.telefono"
                                    type="tel" x-mask="{{ $form->telephone_mask }}" maxlength="{{ $form->telephone_length }}"
                                    @class(['h-12 sm:text-lg', 'block w-full mt-1' ])/>
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.email">
                                {{ __('Escribe tu correo electrónico (opcional):') }}
                            </x-input-label>
                            <div class="mt-2">
                                <x-text-input wire:model="form.email" id="form.email" name="form.email"
                                    type="email" @class(['h-12 sm:text-lg', 'block w-full mt-1']) />
                            </div>
                        </div>
                    </div>

                    {{-- Grado Alcanzado --}}
                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.estudiando">
                                {{ __('¿Te encuentras actualmente estudiando?') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.estudiando_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.estudiando"
                                            id="form.estudiando_1" data-value="Si"
                                            name="form.estudiando" type="radio" value="1" />Si
                                    </x-input-label>
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.estudiando_2">
                                        <x-forms.input-radio type="radio" wire:model.live="form.estudiando"
                                            id="form.estudiando_2" data-value="No"
                                            name="form.estudiando" type="radio" value="2" />No
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.estudiando')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                        <div class="sm:col-span-3" x-cloak x-show="$wire.form.estudiando == 1">
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
                        <div class="sm:col-span-3" x-cloak x-show="$wire.form.estudiando == 2">
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

                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.ha_participado_actividades_glasswing">
                                {{ __('¿Has participado en años anteriores en actividades de Glasswing?') }}
                                <x-required-label />
                            </x-input-label>
                            <div class="px-4 py-3">
                                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.ha_participado_actividades_glasswing_1">
                                        <x-forms.input-radio type="radio" wire:model.live="form.ha_participado_actividades_glasswing"
                                            id="form.ha_participado_actividades_glasswing_1" data-value="Si"
                                            name="form.ha_participado_actividades_glasswing" type="radio" value="1" />Si
                                    </x-input-label>
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.ha_participado_actividades_glasswing_2">
                                        <x-forms.input-radio type="radio" wire:model.live="form.ha_participado_actividades_glasswing"
                                            id="form.ha_participado_actividades_glasswing_2" data-value="No"
                                            name="form.ha_participado_actividades_glasswing" type="radio" value="2" />No
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.ha_participado_actividades_glasswing')" class="mt-2" aria-live="assertive" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        @if ($form->institucionalPoliciaSelect)
                            <div class="sm:col-span-3">
                                <x-input-label class="sm:text-lg" for="form.perfil_institucional_policia_id">
                                    {{ __('Selecciona el perfil de personal de la Policía o cuerpos de seguridad con el que te identificas:') }}
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
                    </div>

                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('DATOS DE SEDE') }}</h3>
                        </div>

                        <div class="sm:col-span-3">
                            <x-input-label class="sm:text-lg" for="form.pertenece_departamento_id">
                                Selecciona el departamento de la sede PNC a la que perteneces:
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
                                Selecciona el distrito de la sede PNC a la que perteneces:
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
                                Selecciona la sede PNC a la que perteneces:
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

                    {{-- AUTORIZACIÓN DE INFORMACIÓN --}}
                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-2 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('AUTORIZACIÓN DE INFORMACIÓN') }}</h3>
                        </div>
                        <div class="col-span-full">
                            <p class="text-lg leading-7 text-justify text-gray-700">
                                Hacemos de su conocimiento que la información solicitada es utilizada para nuestros
                                registros internos, en los cuales llevamos un seguimiento de las y los participantes.
                                Los datos son guardados en una plataforma institucional de único acceso para personal
                                de Glasswing International a cargo del monitoreo e implementación del programa. Para
                                efectos de rendición de cuentas con donantes de nuestros programas y/o socios
                                implementadores, se podrá compartir información de forma general sin detalles personales
                                del registro de la persona participante.
                            </p>
                            <div class="px-4 py-3">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                    <div class="relative flex gap-x-3">
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
                                            <label for="form.autorizacion_informacion" class="sm:text-lg font-bold">
                                                Por lo anterior, confirmo que he leido y se me ha informado el uso que
                                                se le dará a los datos compartidos en este formulario y reconozco que
                                                tengo el derecho de retirar mi autorización en cualquier momento si así
                                                lo estimo conveniente. De ser así, puedes enviar un correo a
                                                "info_sv@glasswing.org" retirando tu autorización para compartir datos.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('form.autorizacion_informacion')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    {{-- FIN AUTORIZACIÓN DE INFORMACIÓN --}}

                    {{-- CONSENTIMIENTO DE PARTICIPACIÓN --}}
                    <div class="grid grid-cols-1 mt-7 gap-x-6 gap-y-2 sm:grid-cols-6">
                        <div class="col-span-full">
                            <h3 class="py-2 my-2 text-2xl font-bold text-gray-900">{{ __('CONSENTIMIENTO DE PARTICIPACIÓN') }}</h3>
                        </div>
                        <div class="col-span-full">
                            <p class="text-lg leading-7 text-justify text-gray-700">
                                Yo <strong class="text-indigo-600">{{ $form->nombres.' '.$form->apellidos }}</strong>,
                                portadora o portador de mi Documento de Identidad  con los últimos cuatro dígitos siguientes <strong class="text-indigo-600">{{ $form->documento_identidad }}</strong>,
                                de <strong class="text-indigo-600">{{ \Carbon\Carbon::parse($form->fecha_nacimiento)->age }}</strong> años de edad,
                                y con número telefónico (opcional) <strong class="text-indigo-600">{{ $form->telefono }}</strong>,
                                hago constar que conozco toda la información necesaria para mi participación (consentimiento de participación, autorización para compartir datos)
                                y que los campos de autorización han sido marcados por mi persona. Por tanto
                                <select wire:model.live="form.consentimiento" class="inline rounded-md  sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm sm:text-lg">
                                    <option value="0"></option>
                                    <option value="1">Acepto</option>
                                </select>
                                participar de forma VOLUNTARIA en el programa. Comprendiendo que Glasswing International posee protocolos que protegen mi participación.
                            </p>

                            <x-input-error :messages="$errors->get('form.consentimiento')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                    {{-- FIN CONSENTIMIENTO DE PARTICIPACIÓN --}}
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8" x-cloak x-show="$wire.form.fecha_nacimiento_validacion == true && $wire.form.institucion_organizacion_id != null">
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

