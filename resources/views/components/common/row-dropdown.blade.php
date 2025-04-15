@props(['formulario', 'pais', 'nombre'])

<x-menu>
    <x-menu.button class="p-2 rounded hover:bg-gray-100">
        <x-icon.ellipsis-vertical />
    </x-menu.button>

    <x-menu.items>
        @if (auth()->user()->can('Editar seguimiento FGSM'))
            @if ($pais->id == 2 && $formulario->paisPerfilSeguimiento->perfilSeguimiento->id == App\Models\PerfilSeguimiento::PERFIL_POLICIA)
            <x-menu.close>
                <x-menu.link
                    href="{{ route('seguimiento.edit.policia', [$pais, $formulario->id, $formulario->codigo_confirmacion ]) }}"
                    {{-- href="{{ route('admin.seguimiento.edit', [$pais, $formulario->id, ]) }}" --}}
                >
                    Editar
                </x-menu.link>
            </x-menu.close>
            @else
                <x-menu.close>
                    <x-menu.link
                        wire:navigate
                        href="/pais/{{ $pais->slug }}/seguimiento/{{ $formulario->id }}/formacion-general/{{ $formulario->codigo_confirmacion }}"
                        {{-- href="{{ route('admin.seguimiento.edit', [$pais, $formulario->id, ]) }}" --}}
                    >
                        Editar
                    </x-menu.link>
                </x-menu.close>
            @endif
        @endif
    </x-menu.items>
</x-menu>
