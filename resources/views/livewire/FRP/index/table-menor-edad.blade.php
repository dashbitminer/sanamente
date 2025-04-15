<div class="flow-root mt-8">

    <div class="flex flex-col grid-cols-8 gap-2 my-4 sm:grid">
        <x-common.search />

        {{-- <x-FGSM.index.bulk-actions /> --}}

    </div>

    {{-- <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8"> --}}
    <div class="-mx-4 -my-2 overflow-x-auto lg:overflow-visible sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="relative">
                <table class="min-w-full divide-y divide-gray-300 table-fixed">
                    <tr>
                        <th class="p-3 text-sm font-semibold text-left text-gray-900">
                            <div class="flex items-center">
                                <x-common.check-all />
                            </div>
                        </th>
                        <th scope="col" class="w-1/6 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            <div class="whitespace-nowrap">Nombre</div>
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Edad
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Nombre Persona Responsable
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Doc. de identidad Persona Responsable
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                           <div class="whitespace-nowrap">Fecha de registro de referencia</div>
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($formularios as $formulario)
                        <tr wire:key='rand-{{ $formulario->id }}'>
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
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-5 text-sm text-gray-500">
                                {{ $formulario->edad() }}
                            </td>
                            <td class="px-3 py-5 whitespace-nowrap">
                                {{ $formulario->nombre_persona_responsable }}
                                <div class="mt-1 text-gray-500">{{-- $formulario->codigo_confirmacion --}}</div>
                                <div class="mt-1 text-gray-500">{{ $formulario->telefono_persona_responsable }}</div>
                            </td>
                            
                            <td class="px-3 py-5 text-sm text-gray-500">
                                {{ $formulario->documento_identidad_persona_responsable }}
                            </td>

                            <td class="p-3 text-sm whitespace-nowrap">
                                {{ $formulario->dateForHumans() }}
                            </td>
                            <td
                                class="relative py-5 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0">
                                <div class="flex items-center justify-end">
                                    <x-common.frp-row-dropdown :$formulario
                                        :pais="$pais->slug"
                                        :nombre="$formulario->full_name"
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
