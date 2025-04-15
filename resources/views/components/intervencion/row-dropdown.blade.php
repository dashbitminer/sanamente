@props(['formulario', 'pais'])

@if(auth()->user()->can('Eliminar intervención directa SM') ||
auth()->user()->can('Editar intervención directa SM'))
<x-menu>
    <x-menu.button class="p-2 rounded hover:bg-gray-100">
        <x-icon.ellipsis-vertical />
    </x-menu.button>
    <x-menu.items>
        @if(auth()->user()->can('Editar intervención directa SM'))
            <x-menu.close>
                <x-menu.link
                    href="/pais/{{ $pais }}/intervenciones/{{ $formulario->id }}/edit"
                >
                    <svg class="mr-3 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                        <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                    </svg>
                    Editar
                </x-menu.link>
            </x-menu.close>
            <x-menu.close>
                <x-menu.link
                    href="/pais/{{ $pais }}/intervenciones/{{ $formulario->id }}/view"
                >
                    <svg class="size-5 mr-3 flex-none stroke-slate-600 text-gray-400" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.25 10c0 1-1.75 6.25-7.25 6.25S2.75 11 2.75 10 4.5 3.75 10 3.75 17.25 9 17.25 10Z"></path>
                        <circle cx="10" cy="10" r="2.25"></circle>
                    </svg>
                    Ver Ficha
                </x-menu.link>
            </x-menu.close>
        @endif
        @if(auth()->user()->can('Eliminar intervención directa SM'))
            <x-menu.close>
                <x-menu.link
                    wire:confirm="Esta seguro que desea eliminar la intervencion?"
                    wire:click="deleteIntervencion({{ $formulario->id }})"
                    class="cursor-pointer"
                >
                    <svg class="mr-3 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                    </svg>
                    Eliminar
                </x-menu.link>
            </x-menu.close>
        @endif
    </x-menu.items>
</x-menu>
@endif
