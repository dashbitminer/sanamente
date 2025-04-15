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
        Información General del Participante. 
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
    
    <form wire:submit="save" class="md:col-span-2">
        <div>
            <div>
                
                @include('livewire.FRP.partials.participante-informacion-fields')
                
            </div>
        </div>
        <div class="flex flex-col items-center justify-end px-4 py-4 sm:flex-row gap-x-6 sm:px-8">

            <button type="submit"
                class="relative w-full px-8 py-3 font-medium text-white rounded-lg bg-azul-glasswing text-uppercase disabled:cursor-not-allowed disabled:opacity-75">
                Guardar
                <div wire:loading.flex
                    class="absolute top-0 bottom-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
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
            <p class="text-lg text-dark-gray">Datos del Participante Actualizados
            </p>
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
</div>
