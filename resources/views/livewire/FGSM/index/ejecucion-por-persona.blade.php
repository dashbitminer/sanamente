<div>

    <div class="flex flex-col grid-cols-8 gap-2 my-10 sm:grid">
        <div class="relative col-span-3 text-sm text-gray-800">
            <div class="absolute top-0 bottom-0 left-0 flex items-center pl-2 text-gray-800 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                        clip-rule="evenodd"></path>
                </svg>

            </div>

            <input wire:model.live.debounce.250ms="search" type="text"
                placeholder="Bucar por nombre, código de usuario, sede o actividad"
                class="block w-full rounded-lg border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>

        <div class="flex flex-col col-span-5 gap-2 sm:flex-row sm:justify-end">


            <div class="hidden sm:flex">
                <form wire:submit="export">
                    <button type="submit"
                    class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-green-600 font-medium text-sm text-white hover:bg-green-500 border-green-600 hover:border-green-500">
                        <svg wire:loading.remove="" wire:target="export" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path
                                d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z">
                            </path>
                            <path
                                d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z">
                            </path>
                        </svg>

                        <svg class="w-4 h-4 text-gray-700 animate-spin" wire:loading="" wire:target="export"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>

                        Exportar
                    </button>
                </form>
            </div>
            <div class="hidden sm:flex">
                <select wire:model.change="perPage"
                    class="flex items-center rounded-lg border py-1.5 bg-white font-medium text-sm">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                    <option value="60">60</option>
                </select>
            </div>
        </div>

    </div>

    <table class="min-w-full mt-8 border border-gray-300 divide-y divide-gray-300">
        <thead>
            <tr class="border border-gray-300 divide-x divide-gray-300 bg-azul-glasswing ">
                <th scope="col" class="py-3.5 pl-4 pr-4 text-center text-sm font-semibold sm:pl-0 text-white uppercase w-1/4">
                    Nombre
                </th>
                <th scope="col" class="px-4 py-3.5 text-center text-sm font-semibold text-white uppercase w-7/20">
                    Sede
                </th>
                <th scope="col" class="px-4 py-3.5 text-center text-sm font-semibold text-white uppercase w-1/10">
                    Cantidad de actividades
                </th>
                <th scope="col" class="px-4 py-3.5 text-center text-sm font-semibold text-white uppercase w-1/5">
                    Detalle
                </th>
                <th scope="col" class="px-4 py-3.5 text-center text-sm font-semibold text-white uppercase w-1/10">
                    Hay registro GWDATA
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">

            @foreach ($formularios as $formulario)
            <tr class="divide-x divide-gray-200">
                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 border-b border-gray-200 sm:pl-6 lg:pl-8"
                    rowspan="{{ count($formulario->actividades) }}">
                    {{ $formulario->full_name }}<br />
                    <span class="py-4 text-sm text-center text-gray-500">{{ $formulario->documento_identidad }}</span>
                </td>
                <td class="hidden px-3 py-4 text-sm text-center text-gray-800 border-b border-gray-200 sm:table-cell"
                    rowspan="{{ count($formulario->actividades) }}">
                    {{ $formulario->escuela->name ?? "" }}
                </td>

                @foreach ($formulario->actividades as $key => $actividad )
                    @if ($loop->first)
                        <td
                            class="hidden px-3 py-4 text-sm text-center text-gray-800 border-b border-gray-200 lg:table-cell">
                            {{ $actividad["count"] ?? '' }}
                        </td>

                        <td class="px-3 py-4 text-sm text-gray-800 border-b border-gray-200 ">
                            {{ $actividad["nombre"] ?? '' }}
                        </td>

                        <td class="hidden px-3 py-4 text-sm text-center text-gray-800 border-b border-gray-200 sm:table-cell"
                            rowspan="{{ count($formulario->actividades) }}">
                            {{ $formulario->record_gwdata }}
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td
                            class="hidden px-3 py-4 text-sm text-center text-gray-800 border border-gray-200 lg:table-cell">
                            {{ $actividad["count"] ?? '' }}
                        </td>
                        <td class="px-3 py-4 text-sm text-gray-800 border border-gray-200 ">
                            {{ $actividad["nombre"] ?? '' }}
                        </td>
                    </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div wire:loading
        wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,departamentoSelected,municipioSelected,escuelaSelected'
        class="absolute inset-0 bg-white opacity-50"></div>

    <div wire:loading.flex
        wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,departamentoSelected,municipioSelected,escuelaSelected'
        class="absolute inset-0 flex items-center justify-center">
        <x-icon.spinner size="8" class="text-gray-500" />
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
</div>
