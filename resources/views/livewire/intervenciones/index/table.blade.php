<div class="flow-root mt-8 ">

    <div x-data="{ open: false }">

        <button type="button" x-show="!open" x-on:click="open = !open"
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg">
            <div>
                Mostrar filtros
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
            </svg>
        </button>

        <button type="button" x-show="open" x-on:click="open = !open"
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg">
            <div>
                Ocultar filtros
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 15.75l7.5-7.5 7.5 7.5"></path>
            </svg>
        </button>

        <div x-show="open" class="mt-4 mb-4">

            <div class="grid grid-cols-1 gap-2 sm:grid-cols-6">
                <div class="col-span-2 sm:col-span-1">
                    <label for="filter1" class="block text-sm font-medium text-gray-700">Departamento</label>
                    <select id="filter1" name="filter1"
                        class="block w-full mt-1 text-sm text-gray-800 border-gray-300 rounded-md shadow-sm"
                        wire:model.live="departamentoSelected">
                        <option value="">Todos</option>
                        @foreach ($departamentos as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="filter2" class="block text-sm font-medium text-gray-700">Municipio</label>
                    <select id="filter2" name="filter2"
                        class="block w-full mt-1 text-sm text-gray-800 border-gray-300 rounded-md shadow-sm"
                        wire:model.live="municipioSelected">
                        <option value="">Todos</option>
                        @foreach ($municipios as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label for="filter3" class="block text-sm font-medium text-gray-700">Sede</label>
                    <div wire:ignore>
                        <select class="block w-full mt-1 text-sm text-gray-800 border-gray-300 rounded-md shadow-sm"
                            data-choice
                            wire:change="$set('escuelaSelected', $event.target.value); console.log($wire.escuelaSelected)"
                            id="escuelaSelectedChoices" @class([ 'block w-full mt-1 h-12 sm:text-lg' , ])>
                            <option value="">Todas</option>
                            @foreach($escuelas as $key => $value)
                            <option value="{{ $key }}" @selected($key==$escuelaSelected)>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-span-1">
                    <x-common.filter-range :$filters />
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <button type="button" wire:click="resetSearch"
                            class="p-2 mt-6 text-gray-500 rounded hover:text-gray-700 hover:bg-gray-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col grid-cols-8 gap-2 my-4 sm:grid">
        <x-intervencion.search />
        <x-intervencion.bulk-actions />
    </div>

    <div class="-mx-4 -my-2 overflow-x-auto lg:overflow-visible sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="relative">
                <table class="min-w-full divide-y divide-gray-300 table-fixed">
                    <thead class="sticky top-0 bg-azul-glasswing">
                        <tr class="border border-gray-300 divide-x divide-gray-300 ">
                            <th class="sticky top-0 p-3 text-sm font-semibold text-left text-white">
                                <div class="flex items-center">
                                    <x-common.check-all />
                                </div>
                            </th>

                            <th scope="col" class="w-1/7 py-3.5 px-2 pl-6 pr-3 text-left text-sm font-semibold text-white sm:pl-2.5">
                                <x-common.sortable column="nombres" :$sortCol :$sortAsc>
                                    <div class="whitespace-nowrap">Nombre</div>
                                </x-common.sortable>
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                DNI
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                Edad
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                Departamento
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                Sede
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                Sede Procedencia
                            </th>
                            <th scope="col" class="w-1/6 px-3 px-3 py-3.5 text-left text-sm font-semibold text-white">
                                <x-common.sortable column="perfil" :$sortCol :$sortAsc>
                                    Tipo de Intervencion
                                </x-common.sortable>
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                Contacto
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">
                                Frecuencia
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 bg-azul-glasswing sm:pr-0">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border border-gray-300 divide-x divide-gray-300">
                        @forelse ($formularios as $formulario)
                        <tr class="border border-gray-300 divide-x divide-gray-300" wire:key='rand-{{ $formulario->id }}'>
                            <td class="p-3 text-sm whitespace-nowrap">
                                <div class="flex items-center">
                                    <input wire:model="selectedRecordIds" value="{{ $formulario->id }}"
                                        type="checkbox" class="border-gray-300 rounded shadow">
                                </div>
                            </td>
                            <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $formulario->intervencionParticipante->fullName }}
                                        </div>
                                        <div class="mt-1 text-gray-500">
                                            @if ($formulario->intervencionParticipante->codigo_confirmacion != null)
                                                {{ $formulario->intervencionParticipante->codigo_confirmacion }}
                                            @else
                                                {{ $formulario->codigo_confirmacion }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">
                                {{ $formulario->intervencionParticipante->documento_identidad }}
                            </td>
                            <td class="px-3 py-5 text-sm whitespace-nowrap">
                                @if ($formulario->intervencionParticipante->fecha_nacimiento != null)
                                    <div class="text-gray-900">{{ $formulario->intervencionParticipante->getEdad($pais) }}</div>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-sm whitespace-nowrap">
                                @if ($formulario->departamento != null)
                                    <div class="text-gray-900">{{ $formulario->departamento->name }}</div>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-sm whitespace-wrap">
                                @if ($formulario->municipio != null)
                                    <div class="text-gray-900">{{ $formulario->municipio->name }}</div>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-sm whitespace-wrap">
                                @if ($formulario->sede != null)
                                    <div class="text-gray-900">{{ $formulario->sede->name }}</div>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-sm text-gray-500">
                                {{ $formulario->tipoIntervencion->pluck('nombre')->join(', ') }}
                            </td>
                            <td class="px-3 py-5 text-sm text-gray-500 text-left">
                                @if ($formulario->intervencionParticipante->telefono != null)
                                    <div class="flex flex-1 text-gray-900">
                                        {{-- <a href="tel:{{ $formulario->intervencionParticipante->telefono }}" class="relative inline-flex flex-1 items-center gap-x-2 rounded-br-lg border border-transparent py-2 text-sm font-semibold text-gray-900">
                                            <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z" clip-rule="evenodd" />
                                            </svg> --}}
                                            {{ $formulario->intervencionParticipante->telefono }}
                                        {{-- </a> --}}
                                    </div>
                                @endif

                                @if ($formulario->intervencionParticipante->email != null)
                                    <div class="flex flex-1">
                                        {{-- <a href="mailto:{{ $formulario->intervencionParticipante->email }}" class="relative -mr-px inline-flex flex-1 items-center gap-x-2 rounded-bl-lg border border-transparent py-2 text-sm font-semibold text-gray-900">
                                            <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                <path d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z" />
                                                <path d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z" />
                                            </svg> --}}
                                            {{ $formulario->intervencionParticipante->email }}
                                        {{-- </a> --}}
                                    </div>
                                @endif
                            </td>
                            <td class="px-3 py-5 text-center text-sm text-gray-500">
                                {{ $formulario->frecuencia() }}
                            </td>
                            <td
                                class="relative py-5 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0">
                                <div class="flex items-center justify-end">
                                    <x-intervencion.row-dropdown :$formulario
                                        :pais="$pais->slug"
                                        wire:key='row-{{ $formulario->id}}' />
                                </div>

                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="py-4 text-center">
                                    No se encontraron participantes
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div wire:loading wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch'
                    class="absolute inset-0 bg-white opacity-50"></div>

                <div wire:loading.flex wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch'
                    class="absolute inset-0 flex items-center justify-center">
                    <x-icon.spinner size="8" class="text-gray-500" />
                </div>
            </div>

        </div>
    </div>
    {{-- Pagination... --}}
    <div class="flex items-center justify-between pt-4">
        <div class="text-sm text-gray-700">
            @php
            $start = ($formularios->count() == 0 ) ? 0 : ($formularios->currentPage() - 1) * $formularios->perPage() + 1;
            $end = min($formularios->currentPage() * $formularios->perPage(), $formularios->total());
            @endphp
            Mostrando {{ $start }} a {{ $end }} de un total de {{
            \Illuminate\Support\Number::format($formularios->total()) }} registros
        </div>

        <div class="text-sm text-gray-700">
            Página actual: {{ $formularios->currentPage() }} de {{ $formularios->lastPage() }}
        </div>

        {{ $formularios->links('livewire.pagination.short-pagination') }}
    </div>

    <style>
        .choices {
            --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }

        .choices__inner {
            background-color: white !important;
            border-radius: 0.375rem !important;
            padding: 4.5px 4.5px 3.75px !important;
            min-height: 24px !important;
            margin-top: 3px;
            --tw-border-opacity: 1 !important;
            border-color: rgb(209 213 219 / var(--tw-border-opacity)) !important;
        }

        .choices__placeholder {
            opacity: 1 !important;
        }

        .choices[data-type*=select-one] .choices__input {
            display: block;
            width: 100%;
            /* padding: 10px; */
            border-bottom: 1px solid #ddd;
            background-color: #fff;
            margin: 0;
            font-size: 0.875rem !important;
            line-height: 1.25rem !important;
            --tw-text-opacity: 1;
            color: rgb(31 41 55 / var(--tw-text-opacity));
        }

        .choices__list--single .choices__item {
            font-size: 0.875rem !important;
            line-height: 1.25rem !important;
            --tw-text-opacity: 1;
            color: rgb(31 41 55 / var(--tw-text-opacity));
        }

        .choices__list--dropdown .choices__item,
        .choices__list[aria-expanded] .choices__item {
            font-size: 14px;
            --tw-text-opacity: 1;
            color: rgb(31 41 55 / var(--tw-text-opacity));
        }
    </style>

</div>

@script
    <script>
        document.addEventListener('livewire:navigated', function () {
        // Initialize Choices.js for the second dropdown
        // new Choices($wire.$el.querySelector('[data-intervencionistas]'), { shouldSort: false });
        let subcategorySelect = new Choices($wire.$el.querySelector('[data-choice]'), { shouldSort: false });
        // Listen for changes in Livewire and update the second dropdown accordingly
        Livewire.on('refresh-choices-filters', subcategories => {

            // Get the dropdown element
            let subcategoryElement = document.getElementById('escuelaSelectedChoices');

            subcategoryElement.innerHTML = '';
            subcategoryElement.innerHTML = '<option value="">Todas</option>';

            for (const [key, value] of Object.entries(subcategories[0])) {

                let newOption = new Option(value, key);
                if ($wire.form.escuelaSelected == key) {
                    newOption.selected = true;
                }
                subcategoryElement.add(newOption);
            }


            subcategorySelect.refresh();
        });
    });
    </script>
@endscript
