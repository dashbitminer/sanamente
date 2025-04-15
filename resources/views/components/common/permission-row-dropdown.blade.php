@props(['permission'])
@if (auth()->user()->can('Editar permisos') || 
    auth()->user()->can('Eliminar permisos'))
<x-menu>
    <x-menu.button class="p-2 rounded hover:bg-gray-100">
        <x-icon.ellipsis-vertical />
    </x-menu.button>

    <x-menu.items>
        @if(auth()->user()->can('Editar permisos'))
            <x-menu.close>
                <x-menu.link
                wire:click="$dispatch('openEdit', { id: {{$permission->id }} })"
                >
                    Editar
                </x-menu.link>
            </x-menu.close>
        @endif

        @if(auth()->user()->can('Eliminar permisos'))
            <x-menu.close>
                <x-menu.item
                    wire:click="delete('{{ $permission->id }}')"
                    wire:confirm="¿Esta seguro que desea eliminar el usuario ?"
                    class="hover:!bg-red-200 text-red-600"
                >
                    Eliminar
                </x-menu.item>
            </x-menu.close>
        @endif
    </x-menu.items>
</x-menu>
@endif