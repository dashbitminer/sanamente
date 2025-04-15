<div>
    <div class="flex flex-col">
        <div class="flex flex-col grid-cols-8 gap-2 my-4 sm:grid">
            <x-buscador-personas.search />

            <x-buscador-personas.bulk-actions />

        </div>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase w-[20%]">
                                    Nombre
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Departamento
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase w-[15%]">
                                    Sede base
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase w-[15%]">
                                    Sede Procedencia
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    ID GWDATA
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Subactividad
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Grupo
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase w-[5%]">
                                    # horas
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase w-[10%]">
                                    Fecha de última sesión
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($participantes as $participante)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap" rowspan="{{ $participante->data->count() }}">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500" rowspan="{{ $participante->data->count() }}">
                                    <div class="font-medium text-gray-900">{{ $participante->participante_name.' '.$participante->participante_lastname }}</div>
                                    <div class="mt-1 text-gray-500">{{ $participante->genero == 1 ? "Hombre" : "Mujer" }}</div>
                                    {{-- "tb.name as tipo_beneficiario",
                                    "ip.name as perfil_institucional", --}}
                                    <div class="mt-1 text-gray-500">
                                        <br/>{{ $participante->tipo_beneficiario }}
                                        @if ($participante->perfil_institucional)
                                            : {{ $participante->perfil_institucional }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap" rowspan="{{ $participante->data->count() }}">
                                    <div class="font-medium text-gray-900">{{ $participante->departamento }}</div>
                                    <div class="mt-1 text-gray-500">{{ $participante->municipio }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500" rowspan="{{ $participante->data->count() }}">
                                    {{ $participante->sede_base ?? '' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500" rowspan="{{ $participante->data->count() }}">
                                    {{ $participante->sede_procedencia ?? '' }}
                                </td>
                                @foreach ($participante->data as $item)
                                    @if ($loop->first)
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->compgroupschoolid }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->subcomponente }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->grupo }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->group_sessions_total_horas > 0 ? ($item->group_sessions_total_horas / 60) : 0 }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if(isset($item->last_group_session_created_at))
                                            {{  \Carbon\Carbon::parse($item->last_group_session_created_at)->format('d-m-Y')  }}
                                            @endif
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->compgroupschoolid }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->subcomponente }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->grupo }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $item->group_sessions_total_horas > 0 ? ($item->group_sessions_total_horas / 60) : 0 }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if(isset($item->last_group_session_created_at))
                                            {{  \Carbon\Carbon::parse($item->last_group_session_created_at)->format('d-m-Y')  }}
                                            @endif
                                        </td>
                                    </tr>

                                    @endif

                                @endforeach

                            @endforeach

                            <!-- More rows... -->
                        </tbody>
                    </table>

                    <div wire:loading
                        {{-- wire:target='sortBy, search, nextPage, previousPage, delete, perPage, $parent.updated, resetSearch, $parent, $filters.paisSelected, $parent.pageComponentUpdate' --}}
                        class="fixed inset-0 z-50 bg-white opacity-50"></div>

                    <div wire:loading.flex
                        {{-- wire:target='sortBy, search, nextPage, previousPage, delete, perPage, $parent.updated,resetSearch, $parent, $filters.paisSelected, $parent.pageComponentUpdate' --}}
                        class="fixed inset-0 z-50 flex items-center justify-center bg-gray-200 bg-opacity-25">
                        <x-icon.spinner size="8" class="text-gray-500" />
                    </div>

                    {{-- Pagination... --}}
                    <div class="flex items-center justify-between pt-4">
                        <div class="mb-4 ml-4 text-sm text-gray-700">
                            @php
                            $start = ($participantes->count() == 0 ) ? 0 : ($participantes->currentPage() - 1) *
                            $participantes->perPage()
                            + 1;
                            $end = min($participantes->currentPage() * $participantes->perPage(),
                            $participantes->total());
                            @endphp
                            Mostrando {{ $start }} a {{ $end }} de un total de {{
                            \Illuminate\Support\Number::format($participantes->total()) }} registros
                        </div>

                        <div class="mb-4 text-sm text-gray-700">
                            Página actual: {{ $participantes->currentPage() }} de {{ $participantes->lastPage() }}
                        </div>
                        <div class="mb-4 mr-4">
                        {{ $participantes->links('livewire.pagination.short-pagination') }}
                        </div>
                    </div>





                </div>
            </div>
        </div>
    </div>
</div>
