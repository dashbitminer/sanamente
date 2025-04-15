<div class="px-4 sm:px-0 text-dark-gray" >
    <div class="flex flex-col items-center justify-between sm:flex-row">
        <div class="flex w-full mb-4 sm:w-1/2 sm:mb-0">
            <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-auto sm:w-4/5">
        </div>
        <div class="flex justify-end w-full sm:w-1/2">
            <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-auto sm:w-4/5">
        </div>
    </div>

    <h1 class="mt-10 mb-10 text-4xl font-bold text-center">Formulario de referencia participantes</h1>
    <p class="mt-4 text-lg leading-7 text-justify text-dark-gray">
        Este formulario deberá ser llenado por la persona que dará seguimiento a la referencia a registrar. 
        Además, se debe completar una única vez al momento de referir por primera vez a la persona participante. 
        Siempre se debe llenar en compañía de la persona adulta que solicita la referencia para contar con los consentimientos 
        necesarios y validar que la información sea veraz. Recuerda que toda la información es confidencial y no deberá ser 
        compartida con terceras personas ni indagar en más información fuera de la solicitada. ¡Muchas gracias!  
    </p>

    @auth
        <div class="mt-10">
            <a href="{{ route('admin.frp.index', ['edad' => $edad]) }}"
                class="block w-full px-8 py-3 font-medium text-white rounded-lg bg-azul-glasswing text-uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline-block w-5 h-5 mr-2 size-5">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                </svg>
                Volver al visualizador
            </a>
        </div>
    @endauth

    <form wire:submit='save' class="md:col-span-2">
        <div x-data="handlerAge">
            <div>
                <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-full">
                        <x-ref-input-label class="sm:text-lg text-dark-gray">{{ __('¿Esta dispuesta(o) a iniciar un proceso de referencia?') }}
                            <x-required-label />
                        </x-ref-input-label>
                        <div class="mt-2 pl-2">
                            <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                                <x-ref-input-label class="flex items-center gap-4" for="form.iniciar_proceso_referencia_1">
                                    <x-forms.input-radio type="radio" wire:model="form.iniciar_proceso_referencia"
                                        id="form.iniciar_proceso_referencia_1"
                                        name="form.iniciar_proceso_referencia" type="radio" value="1" class="h-12 sm:text-lg" />Si
                                </x-ref-input-label>
                                <x-ref-input-label class="flex items-center gap-4" for="form.iniciar_proceso_referencia_0">
                                    <x-forms.input-radio type="radio" wire:model="form.iniciar_proceso_referencia"
                                        id="form.iniciar_proceso_referencia_0"
                                        name="form.iniciar_proceso_referencia" type="radio" value="0" class="h-12 sm:text-lg" />No
                                </x-ref-input-label>
                            </div>
                            <x-input-error :messages="$errors->get('form.iniciar_proceso_referencia')" class="mt-2" />
                        </div>
                    </div>
                </div>
                {{-- PARTE 2: MOTIVOS DE LA REFERENCIA --}}
                    @include('livewire.FRP.partials.referencia-fields')
                {{-- END - PARTE 2: MOTIVOS DE LA REFERENCIA --}}

                {{-- PARTE 3: CONSENTIMIENTO DE QUIENES ACEPTAN REFERENCIA --}}
                    @include('livewire.FRP.partials.consentimiento-fields')
                {{-- END - PARTE 3: CONSENTIMIENTO DE QUIENES ACEPTAN REFERENCIA  --}}

                {{-- PARTE 4: REGISTRO DE QUIENES NO ACEPTAN REFERENCIA --}}
                    @include('livewire.FRP.partials.no-acepta-referencia-fields')
                {{-- END - PARTE 4: REGISTRO DE QUIENES NO ACEPTAN REFERENCIA  --}}
                
            </div>
        </div>

        <div class="flex items-center justify-end px-4 py-4  gap-x-6 sm:px-8 mt-5" x-show="$wire.form.iniciar_proceso_referencia == 0 || $wire.form.iniciar_proceso_referencia == 1">
            <button type="submit"
                class="relative w-full px-8 py-3 font-medium text-white rounded-lg bg-azul-glasswing text-uppercase disabled:cursor-not-allowed disabled:opacity-75 hover:bg-dark-green/90">
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
        <h3 class="text-lg font-semibold leading-6 text-dark-gray" id="modal-title">¡Proceso finalizado!</h3>
        <div class="mt-2">
            <p class="text-lg text-dark-gray">Gracias  for completar el procesosu código de
                confirmación es: <span class="font-semibold">{{ $codigo_confirmacion }}</span></p>
        </div>
    </x-notifications.modal-confirmacion-finalizar>
    
    
     <!-- Error Indicator... -->
     <x-notifications.error-text-notification message="Han habido errores en el formulario" />
    
     <!-- Error Alert... -->
     <x-notifications.alert-error-notification>
         <p class="text-sm font-medium text-red-900">¡Errores en el formulario!</p>
         <p class="mt-1 text-sm text-dark-gray">Han habido problemas para guardar los cambios, corrija cualquier
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
        .choices__list--single .choices__item
        {
            font-size: 1.125rem !important;
            line-height: 1.75rem !important;
        }
        .choices__list--dropdown .choices__item, .choices__list[aria-expanded] .choices__item
         {
            font-size: 18px;
        }
        .choices__inner .choices__item,
        .choices__inner .choices__input {
            font-size: 1rem !important;
            line-height: 1.05rem !important;
        }
    </style>
</div>


@script
<script>
Alpine.data('handlerAge', () => ({
    esMenorDeEdad: false,
    getAge(fecha_nacimiento) {
        this.esMenorDeEdad = false;
        if (fecha_nacimiento) {
            const nacimiento = new Date(fecha_nacimiento);
            const hoy = new Date();
            let edadCalculada = hoy.getFullYear() - nacimiento.getFullYear();
            const mes = hoy.getMonth() - nacimiento.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
                edadCalculada--;
            }
            this.esMenorDeEdad = edadCalculada < 18;
        }
    }
 }))
 </script>
@endscript

