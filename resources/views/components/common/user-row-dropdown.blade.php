@props(['user'])
@if(auth()->user()->hasRole('Super_Admin') || (auth()->user()->can('Editar usuarios') || auth()->user()->can('Eliminar usuarios')))
<x-menu>
    <x-menu.button class="p-2 rounded hover:bg-gray-100">
        <x-icon.ellipsis-vertical />
    </x-menu.button>
    <x-menu.items>
        @if(auth()->user()->can('Editar usuarios') || auth()->user()->hasRole('Super_Admin'))
            <x-menu.close>
                <x-menu.link
                wire:click="$dispatch('openEdit', { id: {{$user->id }} })"
                >
                    Editar
                </x-menu.link>
            </x-menu.close>
        @endif
        @if(auth()->user()->can('Eliminar usuarios') || auth()->user()->hasRole('Super_Admin'))
            <x-menu.close>
                <x-menu.item
                    wire:click="delete('{{ $user->id }}')"
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
