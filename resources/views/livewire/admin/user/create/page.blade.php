<div class="mt-2">
    <div @keydown.window.escape="$wire.openDrawer = false" x-cloak x-show="$wire.openDrawer"
        class="relative z-50" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="fixed inset-y-0 right-0 flex max-w-2xl pl-10 pointer-events-none sm:pl-16">
                    <div x-show="$wire.openDrawer"
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                        @click.away="$wire.openDrawer = false"
                        class="w-screen pointer-events-auto">

                        <form wire:submit="save" enctype="multipart/form-data" class="flex flex-col h-full bg-white divide-y divide-gray-200 shadow-xl">
                            <div class="px-4 py-6 bg-indigo-700 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-base font-semibold leading-6 text-white" id="slide-over-title">
                                        Crear nuevo usuario
                                    </h2>
                                    <div class="flex items-center ml-3 h-7">
                                        <button type="button" @click="$wire.openDrawer = false"
                                            class="relative text-indigo-200 bg-indigo-700 rounded-md hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                            <span class="absolute -inset-2.5"></span>
                                            <span class="sr-only">Close panel</span>
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    <p class="text-sm text-indigo-300">
                                        Completa el formulario con la información del nuevo usuario.
                                    </p>
                                </div>
                            </div>

                            <div class="flex-1 h-0 overflow-y-auto">
                                <div class="py-6 space-y-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">
                                    <div class="px-4 space-y-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                                        <div class="col-span-full mb-1">
                                            <x-input-label for="form.nombre">
                                                {{ __('Nombre:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-text-input  id="form.nombre"
                                                    name="form.nombre" type="text" 
                                                    wire:model="form.nombre"
                                                   @class([
                                                       'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombre')
                                                   ])
                                               />
                                                <x-input-error :messages="$errors->get('form.nombre')"
                                                    class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>  
                                        <div class="col-span-full mb-1">
                                            <x-input-label for="form.email">
                                                {{ __('Email:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-text-input  id="form.email"
                                                    name="form.email" type="email" 
                                                    wire:model="form.email"
                                                   @class([
                                                       'block w-full mt-1','border-2 border-red-500' => $errors->has('form.email')
                                                   ])
                                               />
                                                <x-input-error :messages="$errors->get('form.email')"
                                                    class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                        <div class="col-span-full mb-1">
                                            <x-input-label for="form.password">
                                                {{ __('Contraseña:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-text-input  id="form.password"
                                                    name="form.password" type="password" 
                                                    wire:model="form.password"
                                                   @class([
                                                       'block w-full mt-1','border-2 border-red-500' => $errors->has('form.password')
                                                   ])
                                               />
                                                <x-input-error :messages="$errors->get('form.password')"
                                                    class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>   
                                        <div class="col-span-full mb-1">
                                            <x-input-label for="form.password_confirmation">
                                                {{ __('Confirmar contraseña:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-text-input  id="form.password_confirmation"
                                                    name="form.password_confirmation" type="password"
                                                    wire:model="form.password_confirmation" 
                                                   @class([
                                                       'block w-full mt-1','border-2 border-red-500' => $errors->has('form.password_confirmation')
                                                   ])
                                               />
                                                <x-input-error :messages="$errors->get('form.password_confirmation')"
                                                    class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>  
                                        
                                        <div class="col-span-full mb-2">
                                            <x-input-label for="form.role">
                                                {{ __('Rol:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2 overflow-y-auto h-[200px]">
                                                @foreach ($roles as $key => $value)
                                                    <label class="flex items-center gap-2 px-3 py-2 cursor-pointer hover:bg-gray-100">
                                                        <input value="{{ $key }}"
                                                        wire:model="form.role"
                                                        type="checkbox" class="border-gray-300 rounded">
                                    
                                                        <div class="text-sm text-gray-800">{{ $value }}</div>
                                                    </label>
                                                @endforeach

                                                <x-input-error :messages="$errors->get('form.role')"
                                                    class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <x-input-label for="form.pais">
                                                {{ __('Pais:') }}
                                                <x-required-label />
                                            </x-input-label>
                                            <div class="mt-2">
                                                <x-forms.single-select name="form.pais"
                                                    wire:model='form.pais'
                                                    :options="$paises" selected="Seleccione una opción"
                                                    @class([ 
                                                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.pais')])
            
                                                    />
                                                <x-input-error :messages="$errors->get('form.pais')"
                                                    class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <div class="mt-2">
                                                <label class="flex items-center gap-2 px-3 py-2">
                                                    <input
                                                    wire:model="form.active"
                                                    type="checkbox" class="border-gray-300 rounded">
                                
                                                    <div class="text-sm text-gray-800">Activar usuario</div>
                                                </label>
                                                <x-input-error :messages="$errors->get('form.pais')"
                                                    class="mt-2" aria-live="assertive" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end flex-shrink-0 px-4 py-4">
                                <button type="button" @click="$wire.openDrawer = false"
                                    class="px-3 py-2 text-sm font-semibold text-gray-900 bg-white rounded-md shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="inline-flex justify-center px-3 py-2 ml-4 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Crear usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-notifications.modal-confirmacion-finalizar>
        <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">¡Usuario creado exitosamente!</h3>
        <div class="mt-2">
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
</div>