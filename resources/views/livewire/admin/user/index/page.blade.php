<div class="py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Usuarios</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Consulta la lista de usuarios registrados.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                @if(auth()->user()->can('Crear usuarios') || auth()->user()->hasRole('Super_Admin'))
                    <a  wire:click="$dispatch('openCreate')"
                        role="button"
                        class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                        Crear usuario
                    </a>
                @endif
            </div>
        </div>

        <div
            class="flex flex-col items-start justify-start gap-4 mt-4 sm:flex-row sm:justify-between sm:items-center">
            <div class="flex flex-col gap-1"></div>
            <div class="flex gap-2">
                {{-- <x-participante.index.filter-participantes :$filters />  --}}

                {{-- <x-common.filter-range :$filters /> --}}
            </div>
        </div>

        <div class="my-2">
            {{-- <x-participante.index.filter-status :$filters /> --}}
        </div>

        <livewire:admin.user.index.table  :$filters/>

    </div>
    @if(auth()->user()->can('Crear usuarios'))
        <livewire:admin.user.create.page />
    @endif

    @if(auth()->user()->can('Editar usuarios'))
        <livewire:admin.user.edit.page />
    @endif
</div>
