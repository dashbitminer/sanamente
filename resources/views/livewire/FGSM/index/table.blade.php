<div class="flow-root mt-2">

    <div x-data="{ open: false }">

        <button type="button" x-show="!open" x-on:click="open = !open"
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg"
            aria-expanded="false">
            <div>
                Mostrar filtros
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
            </svg>
        </button>

        <button type="button" x-show="open" x-on:click="open = !open"
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg"
            aria-expanded="false">
            <div>
                Ocultar filtros
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 15.75l7.5-7.5 7.5 7.5"></path>
            </svg>
        </button>


        {{-- <button @click="open = !open" class="text-blue-500 hover:underline">
            <span x-show="!open">Mostrar filtros</span>
            <span x-show="open">Ocultar filtros</span>
        </button> --}}
        <div x-show="open" class="mt-4 mb-4">

            <div class="grid grid-cols-1 gap-2 sm:grid-cols-8">
                @can("Acceso total")
                <div class="col-span-2 sm:col-span-1">
                    <label for="filter1" class="block text-sm font-medium text-gray-700">Paises</label>
                    <select id="filter1" name="filter1"
                        class="block w-full mt-1 text-sm text-gray-800 border-gray-300 rounded-md shadow-sm"
                        wire:model.live="paisSelected">
                        <option value="">Todos</option>
                        @foreach ($paises as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                @endcan
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
        <x-common.search />

        <x-FGSM.index.bulk-actions />

    </div>

    {{-- <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"> --}}
        <div class="-mx-4 -my-2 overflow-x-auto lg:overflow-visible sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="relative">
                    <table class="min-w-full divide-y divide-gray-300 table-fixed">
                        <tr class="border border-gray-300 divide-x divide-gray-300 bg-azul-glasswing ">
                            <th class="p-3 text-sm font-semibold text-left text-gray-900">
                                <div class="flex items-center">
                                    <x-common.check-all />
                                </div>
                            </th>

                            <th scope="col"
                                class="w-1/6 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white uppercase sm:pl-0">
                                <x-common.sortable column="nombres" :$sortCol :$sortAsc>
                                    <div class="whitespace-nowrap">NOMBRE</div>
                                </x-common.sortable>
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white uppercase">
                                Documento de identidad
                            </th>
                            <th scope="col" class="w-2/6 px-3 py-3.5 text-left text-sm font-semibold text-white uppercase">
                                <x-common.sortable column="perfil" :$sortCol :$sortAsc>
                                    PERFIL
                                </x-common.sortable>
                            </th>
                            <th scope="col" class="w-12/6 px-3 py-3.5 text-left text-sm font-semibold text-white uppercase">
                                Escuela/Sede
                            </th>

                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white uppercase">
                                <x-common.sortable column="fecha" :$sortCol :$sortAsc>
                                    <div class="whitespace-nowrap">Fecha de registro</div>
                                </x-common.sortable>
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($formularios as $formulario)
                            <tr wire:key='rand-{{ $formulario->id }}'>
                                <td class="p-3 text-sm border border-gray-300 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <input wire:model="selectedRecordIds" value="{{ $formulario->id }}"
                                            type="checkbox" class="border-gray-300 rounded shadow">
                                    </div>
                                </td>
                                <td class="py-5 pl-4 pr-3 text-sm border border-gray-300 whitespace-nowrap sm:pl-0">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ $formulario->full_name }}</div>
                                            <div class="mt-1 text-gray-500">{{ $formulario->codigo_confirmacion }}</div>
                                            {{-- <div class="mt-1 text-gray-500">{{ $formulario->telefono }}</div> --}}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-5 text-sm text-gray-500 border border-gray-300 whitespace-nowrap">
                                    {{ $formulario->documento_identidad }}
                                </td>
                                <td class="px-3 py-5 text-sm text-gray-500 border border-gray-300">
                                    {{ $formulario->paisPerfilSeguimiento->perfilSeguimiento->nombre }}
                                </td>
                                <td class="px-3 py-5 text-sm text-gray-500 border border-gray-300">
                                    <div class="text-gray-900">{{ $formulario->escuela->name }}</div>
                                    <div class="mt-1 text-gray-500">{{ $formulario->escuela->departamento->name.',
                                        '.$formulario->escuela->municipio->name }}</div>
                                </td>

                                <td class="p-3 text-sm border border-gray-300 whitespace-nowrap">
                                    {{ $formulario->dateForHumans() }}
                                </td>
                                <td
                                    class="relative py-5 pl-3 pr-4 text-sm font-medium text-right border border-gray-300 whitespace-nowrap sm:pr-0">
                                    <div class="flex items-center justify-end">
                                        <x-common.row-dropdown :$formulario :pais="$pais"
                                            :nombre="$formulario->full_name" wire:key='row-{{ $formulario->id}}' />
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div wire:loading
                        wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,departamentoSelected,municipioSelected,escuelaSelected,paisSelected'
                        class="absolute inset-0 bg-white opacity-50"></div>

                    <div wire:loading.flex
                        wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,departamentoSelected,municipioSelected,escuelaSelected,paisSelected'
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
                $start = ($formularios->count() == 0 ) ? 0 : ($formularios->currentPage() - 1) * $formularios->perPage()
                + 1;
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

        {{--
        <x-participante.index.drawer :participante=$selectedParticipante /> --}}


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
