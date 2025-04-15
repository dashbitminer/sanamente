<div class="flow-root mt-8">

    <div class="flex flex-col grid-cols-8 gap-2 my-4 sm:grid">
        <x-common.search />

        <x-ficha.index.bulk-actions />
    </div>

    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="sticky top-0 bg-azul-glasswing">
                    <tr class="border border-gray-300 divide-x divide-gray-300 ">
                        <th class="sticky top-0 p-3 text-sm font-semibold text-left text-white">
                            <div class="flex items-center">
                                <x-common.check-all />
                            </div>
                        </th>
                        <th scope="col"
                            class="w-1/5 py-3.5 px-2 pl-6 pr-3 text-left text-sm font-semibold text-white sm:pl-2.5">
                            Nombre</th>
                        <th scope="col" class="w-1/5 px-3 py-3.5 text-left text-sm font-semibold text-white">
                            Responsable</th>
                        <th scope="col" class="w-1/5 px-3 py-3.5 text-left text-sm font-semibold text-white">
                            Escuela</th>
                        <th scope="col" class="w-1/5 px-3 py-3.5 text-left text-sm font-semibold text-white">
                            Alias</th>
                        <th scope="col" class="w-1/5 px-3 py-3.5 text-left text-sm font-semibold text-white">
                            Creado</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 bg-azul-glasswing sm:pr-0">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white border border-gray-300 divide-x divide-gray-300 ">
                    @foreach($formularios as $formulario)
                    @php
                    $isRegistered = !$formulario->imported_at && !$formulario->deleted_at;
                    @endphp

                    <tr
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
                                    class="border-gray-300 rounded shadow">
                            </div>
                            @endif
                        </td>
                        <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{ Str::upper($formulario->full_name) }}</div>
                                    @if( $isRegistered && auth()->user()->can('Editar registro club NNA'))
                                    <div class="mt-1 text-indigo-600">
                                        <a href="#"
                                         wire:click="$dispatch('openModal', { id: {{$formulario->id }} })"
                                            class="text-xs hover:underline">Edición rápida</a>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">
                            <div class="text-gray-900">{{ $formulario->nombres_responsable }}</div>
                            <div class="mt-1 text-gray-500">{{ $formulario->parentescoGWDATA->name }}</div>
                            <div class="mt-1 text-gray-500">{{ $formulario->documento_identidad }}</div>
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500">
                            <div class="text-gray-900">{{ $formulario->escuelaGWDATA->name ?? "" }}</div>
                            <div class="mt-1 text-gray-500">{{ $formulario->escuelaGWDATA->municipio->name ?? "" }} , {{ $formulario->escuelaGWDATA->departamento->name ?? "" }}</div>
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500">
                            <div class="text-gray-900">{{ $formulario->escuelaGWDATA->alias ?? "" }}</div>
                        </td>
                        <td class="px-3 py-5 text-sm text-gray-500 whitespace-nowrap">{{
                            $formulario->created_at->format("d/m/Y g:i A") }}</td>
                        <td class="relative py-5  text-sm font-medium text-center whitespace-nowrap sm:pr-0">
                            @if( $isRegistered )
                            <div class="flex items-center justify-end">
                                <x-common.nna-row-dropdown :$formulario :pais="$pais" :nombre="$formulario->full_name"
                                    wire:key='row-{{ $formulario->id}}' />
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <!-- More people... -->
                </tbody>
            </table>

            <div
                wire:loading
                wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,openModal'
                class="absolute inset-0 bg-white opacity-50"></div>

            <div
                wire:loading.flex
                wire:target='sortBy, search, nextPage, previousPage, delete, perPage, __dispatch,resetSearch,openModal'
                class="fixed inset-0 flex items-center justify-center transition-opacity bg-gray-200 bg-opacity-25"
                >
                <x-icon.spinner size="8" class="text-gray-500" />
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
    @if (auth()->user()->can('Editar registro club NNA'))
        <livewire:club-n-n-a.create.modal :$pais />
    @endif

    @if (auth()->user()->can('Importar registros club NNA a GWDATA'))
        <div>
            <div
                x-data="{
                    progress: 0,
                    get progressStyle() {
                        return `width: ${this.progress}%`
                    }
                }"
                x-on:progress-updated.window="progress = $event.detail.progress; console.log($event.detail.progress)"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                x-show="$wire.isOpen"
                x-cloak
            >
                <!-- Modal Content -->
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-full p-4">
                        <div class="w-full max-w-sm px-4 pt-5 pb-4 bg-white rounded-lg sm:p-6 sm:pb-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium leading-6 text-gray-900" x-text="progress == 100 ? 'Completado' : 'Procesando...'"></h3>
                                <button type="button" @click="$wire.isOpen = false" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300" x-bind:style="progressStyle"></div>
                            </div>

                            <!-- Progress Percentage -->
                            <div class="mt-2 text-center">
                                <span x-text="progress + '%'"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
