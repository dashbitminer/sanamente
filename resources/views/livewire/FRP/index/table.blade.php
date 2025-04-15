<div class="flow-root mt-8">

    <div x-data="{ open: false }">

        <button type="button" x-show="!open" @click="open = !open" x-popover:button=""
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg"
            id="alpine-popover-button-1" aria-expanded="false">
            <div>
                Mostrar filtros
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
            </svg>
        </button>

        <button type="button" x-show="open" @click="open = !open" x-popover:button=""
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg"
            id="alpine-popover-button-1" aria-expanded="false">
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
                {{--<div class="col-span-2">
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
                </div>--}}
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
        <x-common.search-referencias />

        <x-FRP.index.bulk-actions />

    </div>

    {{-- <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"> --}}
    <div class="-mx-4 -my-2 overflow-x-auto lg:overflow-visible sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="relative">
                <table class="min-w-full divide-y divide-gray-300 table-fixed">
                    <tr class="bg-azul-glasswing border border-gray-300 divide-x divide-gray-300">
                        <th class="p-3 text-sm font-semibold text-left text-gray-900">
                            <div class="flex items-center">
                                <x-common.check-all />
                            </div>
                        </th>

                        <th scope="col" class="w-[20%] py-3.5 px-2 pl-4 pr-3 text-left text-sm font-semibold text-white">
                            <div class="whitespace-nowrap">Nombre</div>
                        </th>
                        <th scope="col" class="w-[13%] py-3.5 px-3 pl-4 pr-3 text-left text-sm font-semibold text-white">
                            <div class="whitespace-nowrap">Institución a la que refiere</div>
                        </th>
                        <th scope="col" class="w-[5%] px-3  py-3.5 text-left text-sm font-semibold text-white">
                            Edad
                        </th>
                        <th scope="col" class="w-[10%] px-3 py-3.5 text-left text-sm font-semibold text-white">
                            # de telefono
                        </th>
                        <th scope="col" class="w-[5%] px-3 py-3.5 text-left text-sm font-semibold text-white">
                            # de Seguimientos
                        </th>
                        <th scope="col" class="w-[13%] px-3 py-3.5 text-left text-sm font-semibold text-white">
                            Servicio
                        </th>
                        <th scope="col" class="w-[13%] px-3 py-3.5 text-left text-sm font-semibold text-white">
                            Estado
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                    <tbody class="bg-white border border-gray-300 divide-x divide-gray-300">
                        @foreach ($formularios as $formulario)
                        <tr wire:key='rand-{{ $formulario->id }}'
                            @class([
                            'border border-gray-300 divide-x divide-gray-300 '
                        ])>
                            <td class="p-3 text-sm whitespace-nowrap">
                                <div class="flex items-center">
                                    <input wire:model="selectedRecordIds" value="{{ $formulario->id }}"
                                        type="checkbox" class="border-gray-300 rounded shadow">
                                </div>
                            </td>
                            <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $formulario->fullName() }}</div>
                                        <div class="mt-1 text-gray-500">{{-- $formulario->codigo_confirmacion --}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">
                                {{ ($formulario->institucion ?? 'N/A') }}
                            </td>
                            <td class="px-3 py-5 text-sm text-gray-500">
                                {{ $formulario->edad() }}
                            </td>
                            <td class="px-3 py-5 text-sm text-gray-500">
                                {{ $formulario->telefono }}
                            </td>
                            <td class="p-3 text-sm whitespace-nowrap">
                                {{ $formulario->referencias_count }}
                            </td>
                            <td class="p-3 text-sm whitespace-nowrap">
                                {!! nl2br(e($formulario->servicios)) !!}
                            </td>
                            <td class="p-3 text-sm whitespace-nowrap">
                               {{ $formulario->detalle_seguimiento }}
                            </td>
                            <td
                                class="relative py-5 text-sm font-medium text-center whitespace-nowrap sm:pr-0">
                                <div class="flex items-center justify-center">
                                    <x-common.frp-row-dropdown :$formulario
                                        :pais="$pais->slug"
                                        :nombre="$formulario->fullName()"
                                        :edad="$edad"
                                        wire:key='row-{{ $formulario->id}}' />
                                </div>

                            </td>
                        </tr>
                        @endforeach
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
</div>
