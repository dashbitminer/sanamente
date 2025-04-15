<div class="py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Permisos</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Controla los accesos y privilegios de cada usuario.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                @if (auth()->user()->can('Crear permisos'))
                    <a  wire:click="$dispatch('openCreate')"
                        role="button"
                        class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                        Agregar Permiso
                    </a>
                @endif
            </div>
        </div>

        <livewire:admin.permisos.index.table />
    </div>
    @if (auth()->user()->can('Crear permisos'))
        <livewire:admin.permisos.create.page />
    @endif

    @if (auth()->user()->can('Editar permisos'))
        <livewire:admin.permisos.edit.page />
    @endif
</div>
