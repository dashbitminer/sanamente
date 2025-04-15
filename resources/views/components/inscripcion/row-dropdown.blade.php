@props(['formulario', 'pais', 'nombre'])

@if (auth()->user()->can('Editar inscripción formaciones SM') ||
    auth()->user()->can('Eliminar inscripción formaciones SM'))
<x-menu>
    <x-menu.button class="p-2 rounded hover:bg-gray-100">
        <x-icon.ellipsis-vertical />
    </x-menu.button>

    <x-menu.items>
        @if (auth()->user()->can('Editar inscripción formaciones SM'))
            @if ($formulario->is_pnc)
            <x-menu.close>
                <x-menu.link
                    wire:navigate
                    href="/pais/{{ $pais->slug }}/inscripcion-pnc/{{ $formulario->id }}/edit"
                >
                    Editar
                </x-menu.link>
            </x-menu.close>
            @else
            <x-menu.close>
                <x-menu.link
                    wire:navigate
                    href="/pais/{{ $pais->slug }}/inscripcion/{{ $formulario->id }}/edit"
                >
                    Editar
                </x-menu.link>
            </x-menu.close>
            @endif
        @endif

        @if (auth()->user()->can('Eliminar inscripción formaciones SM'))
            <x-menu.close>
                <x-menu.item
                    wire:click.prevent="delete('{{ $formulario->id }}')"
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
