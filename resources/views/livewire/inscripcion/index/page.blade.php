<div class="py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Importador de Inscripciones</h1>
                <p class="mt-2 text-sm text-gray-700">Formulario de Inscripcion y registros</p>
            </div>
            <div x-data="{ showTooltip: false, showTooltipPolicia: false, url: '{{ route('inscripcion.create', $pais) }}', urlPolicia: '{{ route('inscripcion.create.policia', $pais) }}' }">

                <div class="flex justify-end mt-4 text-sm sm:ml-16 sm:mt-0 sm:flex-none">

                    <div x-show="showTooltip" class="px-2 py-2 tooltip show ">
                        Enlace copiado
                    </div>

                    <div class="relative">
                        <a href="#" role="button"
                            x-on:click="navigator.clipboard.writeText(url); showTooltip = true; setTimeout(() => showTooltip = false, 2000)"
                            class="inline-flex items-center px-2 py-2 font-medium text-indigo-600 group hover:text-indigo-900">
                            <svg class="text-indigo-500 size-5 group-hover:text-indigo-900" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path
                                    d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z">
                                </path>
                                <path
                                    d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z">
                                </path>
                            </svg>
                            <span class="ml-2">Copiar Enlace</span>
                        </a>

                    </div>

                    <a href="{{ route('inscripcion.create', $pais) }}"
                        wire:navigate role="button"
                        class="block px-2 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Nueva Inscripcion
                    </a>
                </div>

                @if ($pais->id == 2)
                <div class="flex justify-end mt-5 text-sm sm:ml-16 sm:flex-none">

                    <div x-show="showTooltipPolicia" class="px-2 py-2 tooltip show ">
                        Enlace copiado
                    </div>

                    <div class="relative">
                        <a href="#" role="button"
                            x-on:click="navigator.clipboard.writeText(urlPolicia); showTooltipPolicia = true; setTimeout(() => showTooltipPolicia = false, 2000)"
                            class="inline-flex items-center px-3 py-2 font-medium text-sky-600 group hover:text-sky-900">
                            <svg class="text-sky-500 size-5 group-hover:text-sky-900" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path
                                    d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z">
                                </path>
                                <path
                                    d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z">
                                </path>
                            </svg>
                            <span class="ml-2">Copiar Enlace</span>
                        </a>

                    </div>

                    <a href="{{ route('inscripcion.create.policia', $pais) }}"
                        wire:navigate role="button"
                        class="block px-2 py-2 ml-4 text-sm font-semibold text-center text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                        Nueva Inscripcion Policia
                    </a>
                </div>
                @endif

            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-3">
            @foreach ($filters->estados() as $estado)
            <div class="p-4 bg-{{ $estado["color"] }}-200  rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-{{ $estado["color"] }}-900">{{ $estado["nombre"] }}</h3>
                <p class="mt-1 text-base text-gray-600">Total: {{ $estado["total"] }}</p>
            </div>
            @endforeach
        </div>

        <div
            class="flex flex-col items-start justify-start gap-4 mt-6 sm:flex-row sm:justify-between sm:items-center">
            <div class="flex flex-col gap-1">
            </div>
            <div class="flex gap-2 mt-6">
                <x-inscripcion.filter-status :$filters />

                <x-inscripcion.filter-range :$filters />
            </div>
        </div>

        <x-inscripcion.filters-dropdowns :$filters :$departamentos :$ciudades :$escuelas/>

        <div class="my-2">
            {{-- <x-common.filter-status :$filters /> --}}
        </div>

        <livewire:inscripcion.index.table :$filters :$pais  />
    </div>
</div>
