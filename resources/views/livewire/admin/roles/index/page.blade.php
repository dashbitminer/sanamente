<div class="py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Roles</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Crea, edita y elimina roles de los usuarios.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                @if (auth()->user()->can('Crear roles'))
                    <a  wire:click="$dispatch('openCreate')"
                        role="button"
                        class="block px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                        Agregar Role
                    </a>
                @endif
            </div>
        </div>
        <livewire:admin.roles.index.table />
    </div>
    @if (auth()->user()->can('Crear roles'))
        <livewire:admin.roles.create.page />
    @endif

    @if (auth()->user()->can('Editar roles'))
        <livewire:admin.roles.edit.page />
    @endif
</div>
