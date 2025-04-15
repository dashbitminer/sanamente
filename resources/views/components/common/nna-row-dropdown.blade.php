@props(['formulario', 'pais', 'nombre'])
@if (auth()->user()->can('Eliminar registro club NNA'))
<x-menu>
    <x-menu.button class="p-2 rounded hover:bg-gray-100">
        <x-icon.ellipsis-vertical />
    </x-menu.button>
    <x-menu.items>
        @if (auth()->user()->can('Eliminar registro club NNA'))
            <x-menu.close>
                <x-menu.item
                    wire:click="delete('{{ $formulario->id }}')"
                    wire:confirm="¿Esta seguro que desea eliminar la ficha de registro ?"
                    class="hover:!bg-red-200 text-red-600"
                >
                    Eliminar
                </x-menu.item>
            </x-menu.close>
        @endif
    </x-menu.items>
</x-menu>
@endif