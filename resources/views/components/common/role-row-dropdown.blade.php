@props(['role'])
@if (auth()->user()->can('Editar roles') || 
    auth()->user()->can('Eliminar roles')) 
<x-menu>
    <x-menu.button class="p-2 rounded hover:bg-gray-100">
        <x-icon.ellipsis-vertical />
    </x-menu.button>

    <x-menu.items>
        @if (auth()->user()->can('Editar roles'))
            <x-menu.close>
                <x-menu.link
                wire:click="$dispatch('openEdit', { id: {{$role->id }} })"
                >
                    Editar
                </x-menu.link>
            </x-menu.close>
        @endif
        @if (auth()->user()->can('Eliminar roles'))
            <x-menu.close>
                <x-menu.item
                    wire:click="delete('{{ $role->id }}')"
                    wire:confirm="¿Esta seguro que desea eliminar el role ?"
                    class="hover:!bg-red-200 text-red-600"
                >
                    Eliminar
                </x-menu.item>
            </x-menu.close>
        @endif
    </x-menu.items>
</x-menu>
@endif