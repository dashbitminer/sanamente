<div class="flow-root mt-8">

    <div class="flex flex-col grid-cols-8 gap-2 my-4 sm:grid">
        <x-inscripcion.search />

        <x-inscripcion.bulk-actions />
    </div>


    <div class="overflow-x-auto -mx-4 -my-2 sm:-mx-6 lg:-mx-8">
        <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300 table-fixed">
                <thead class="sticky top-0 bg-azul-glasswing">
                    <tr class="border border-gray-300 divide-x divide-gray-300">
                        <th class="sticky top-0 p-3 text-sm font-semibold text-left text-white">
                            <div class="flex items-center">
                                <x-common.check-all />
                            </div>
                        </th>
                        <th scope="col" class="py-3.5 text-sm font-semibold text-left text-white">
                            Codigo</th>
                        <th scope="col" class="px-2 py-3.5 pr-3 pl-6 w-1/5 text-sm font-semibold text-left text-white sm:pl-2.5">
                            <x-common.sortable column="nombres" :$sortCol :$sortAsc>Nombre</x-common.sortable>
                        </th>
                        <th scope="col" class="py-3.5 text-sm font-semibold text-left text-white">
                            <x-common.sortable column="sexo" :$sortCol :$sortAsc>Sexo</x-common.sortable>
                        </th>
                        <th scope="col" class="py-3.5 text-sm font-semibold text-left text-white">
                            Fec. Nacimiento</th>
                        <th scope="col" class="px-2 py-3.5 pr-3 pl-6 w-1/4 text-sm font-semibold text-left text-white sm:pl-2.5">
                            <x-common.sortable column="perfil" :$sortCol :$sortAsc>Perfil</x-common.sortable>
                        </th>
                        <th scope="col" class="px-2 py-3.5 pr-3 pl-6 w-1/4 text-sm font-semibold text-left text-white sm:pl-2.5">
                            Sede de Procedencia
                        </th>
                        <th scope="col" class="py-3.5 text-sm font-semibold text-left text-white">
                            Voz e Imagen</th>
                        <th scope="col" class="py-3.5 w-1/5 text-sm font-semibold text-left text-white">
                            <x-common.sortable column="creado" :$sortCol :$sortAsc>Creado</x-common.sortable>
                        </th>
                        <th scope="col" class="relative py-3.5 pr-4 pl-3 bg-azul-glasswing sm:pr-0">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white border border-gray-300 divide-x divide-gray-300">
                    @foreach($formularios as $formulario)
                    @php
                    $isRegistered = !$formulario->imported_at && !$formulario->deleted_at;
                    @endphp

                    <tr wire:key='rand-{{ $formulario->id }}'
                    @class([
                        'bg-green-50'=> $formulario->imported_at,
                        'bg-red-50'=> $formulario->deleted_at,
                        'border border-gray-300 divide-x divide-gray-300 '
                    ])>
                        <td
                            @class([
                                'p-3 text-sm whitespace-nowrap',
                                'border-l-4 border-l-green-500'=> $formulario->imported_at,
                                'border-l-4 border-l-red-500'=> $formulario->deleted_at,
                                'border-l-4 border-l-blue-500'=> !$formulario->imported_at && !$formulario->deleted_at,
                            ])>
                            @if( $isRegistered )
                            <div class="flex items-center">
                                <input wire:model="selectedRecordIds" value="{{ $formulario->id }}" type="checkbox"
                                    class="rounded border-gray-300 shadow">
                            </div>
                            @endif
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">
                            <div class="text-gray-900">{{ $formulario->codigo_confirmacion }}</div>
                        </td>
                        <td class="py-5 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-0">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">
                                        {{ Str::upper($formulario->full_name) }}
                                    </div>
                                    <div class="mt-1 text-gray-500">{{ $formulario->documento_identidad }}</div>
                                    @if( $isRegistered )
                                    <div class="mt-1 text-indigo-600">
                                        <a href="#"
                                         wire:click.prevent="$dispatch('openModalInscripcion', { inscripcion: {{ $formulario->id }} })"
                                            class="text-xs hover:underline">Edición rápida</a>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">
                            <div class="text-gray-900">{{ $formulario->sexo == 1 ? 'Hombre' : 'Mujer' }}</div>
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500">
                            <div class="text-gray-900">
                                {{ \Carbon\Carbon::parse($formulario->fecha_nacimiento)->format('d/m/Y') }}
                            </div>
                        </td>
                        <td class="px-3 space-y-3 text-sm">
                            <div class="font-medium text-gray-900">{{ $formulario->personalInstitucional->name ?? '' }}</div>

                            @if ($formulario->personalInstitucional)
                                @if ($formulario->personalInstitucional->name == 'Docentes de Educación')
                                    <div class="text-gray-600">{{ $formulario->beneficiarioSubtipoEducacion->name }}</div>
                                @endif

                                @if ($formulario->personalInstitucional->name == 'Personal de organizaciones')
                                    <div class="text-gray-600">{{ $formulario->beneficiarioSubtipoOrganizaciones->name }}</div>
                                @endif

                                @if ($formulario->personalInstitucional->name == 'Personal de la Policía')
                                    <div class="text-gray-600">{{ $formulario->sanamenteSubtiposPolicia->name }}</div>

                                    @if ($formulario->personalInstitucional->name == 'Personal de la Policía Nacional')
                                        <div class="text-gray-500">{{ $formulario->beneficiarioSubtipoPoliciaRango->name }}</div>
                                    @endif
                                @endif

                                @if ($formulario->personalInstitucional->name == 'Personal de Salud')
                                    <div class="text-gray-600">{{ $formulario->sanamenteSubtiposSalud->name }}</div>

                                    @if (str_contains($formulario->sanamenteSubtiposSalud->name, 'Personal de Hospital')
                                        || str_contains($formulario->sanamenteSubtiposSalud->name, 'Personal de Unidad'))
                                        <div class="text-gray-500">{{ $formulario->beneficiarioSubtipoSalud->name }}</div>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500">
                            @if ($formulario->perteneceSede != null)
                                <div class="text-gray-900">{{ $formulario->perteneceSede->name }}</div>
                            @endif
                            @if ($formulario->perteneceDepartamento != null)
                                <div class="text-gray-500">{{ $formulario->perteneceDepartamento->name }}</div>
                            @endif
                            @if ($formulario->perteneceMunicipio != null)
                                <div class="text-gray-500">{{ $formulario->perteneceMunicipio->name }}</div>
                            @endif
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">
                            <div class="text-gray-900">{{ $formulario->derechos_image_voz == 1 ? 'Si' : 'No' }}</div>
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">{{
                            $formulario->created_at->format("d/m/Y g:i A") }}</td>
                        <td class="relative py-5 pr-4 pl-3 text-sm font-medium text-right whitespace-nowrap sm:pr-0">
                            @if( $isRegistered )
                            <div class="flex justify-end items-center">
                                <x-inscripcion.row-dropdown :$formulario :pais="$pais" :nombre="$formulario->full_name"
                                    wire:key='row-{{ $formulario->id}}' />
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div
                wire:loading
                wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,quickEdit'
                class="absolute inset-0 bg-white opacity-50"></div>

            <div
                wire:loading.flex
                wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,quickEdit'
                class="flex fixed inset-0 justify-center items-center bg-gray-200 bg-opacity-25 transition-opacity"
                >
                <x-icon.spinner size="8" class="text-gray-500" />
            </div>

        </div>
    </div>


    {{-- Pagination... --}}
    <div class="flex justify-between items-center pt-4">
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

    <livewire:inscripcion.create.modal :$pais />

    <div>


        <!-- Modal Backdrop -->
        <div
            x-data="{
                progress: 0,
                get progressStyle() {
                    return `width: ${this.progress}%`
                }
            }"
            x-on:progress-updated.window="progress = $event.detail.progress;"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
            x-show="$wire.isOpen"
            x-cloak
        >
            <!-- Modal Content -->
            <div class="overflow-y-auto fixed inset-0 z-10">
                <div class="flex justify-center items-center p-4 min-h-full">
                    <div class="px-4 pt-5 pb-4 w-full max-w-sm bg-white rounded-lg sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" x-text="progress == 100 ? 'Completado' : 'Procesando...'"></h3>
                            <button type="button" @click="$wire.isOpen = false" class="text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full h-2.5 bg-gray-200 rounded-full">
                            <div class="h-2.5 bg-blue-600 rounded-full transition-all duration-300" x-bind:style="progressStyle"></div>
                        </div>

                        <!-- Progress Percentage -->
                        <div class="mt-2 text-center">
                            <span x-text="progress + '%'"></span>
                        </div>

                        <!-- Progress Text -->
                        <div class="mt-2 text-center" x-show="progress == 100">
                            <span>¡Listo! {{ $count_imported }} registros se han importado con éxito</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
