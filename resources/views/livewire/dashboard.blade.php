<div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        @if(auth()->user()->can('Ver seguimientos FGSM'))
            <a href="/pais/{{ $usuario->pais->slug }}/formacion-general/{{ auth()->user()->uuid }}/{{ auth()->user()->email }}" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Seguimiento formación general</h5>
                <p class="font-normal text-gray-700">{{ $usuario->pais->nombre }}</p>
            </a>
        @endif
        @if(auth()->user()->can('Ver intervenciones directas SM'))
            <a href="/pais/{{ $usuario->pais->slug }}/intervenciones" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Registro de intervenciones directas</h5>
                <p class="font-normal text-gray-700">{{ $usuario->pais->nombre }}</p>
            </a>
        @endif
    </div>
</div>
