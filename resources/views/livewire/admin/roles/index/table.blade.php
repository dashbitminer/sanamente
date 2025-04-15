<div class="flow-root mt-8">
    <div class="-mx-4 -my-2 overflow-x-auto lg:overflow-visible sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="relative">
                <table class="min-w-full divide-y divide-gray-300 table-fixed">
                    <tr>
                        <th scope="col" class="w-[95%] py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            <x-common.sortable column="nombres" :$sortCol :$sortAsc>
                                <div class="whitespace-nowrap">Nombre</div>
                            </x-common.sortable>
                        </th>
                        <th class=""></th>
                    </tr>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($roles as $role)
                        <tr wire:key='rand-{{ $role->id }}'>
                            <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $role->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="relative py-5 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0">   
                                <x-common.role-row-dropdown :$role wire:key='row-{{ $role->id}}' />
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
            $start = ($roles->count() == 0 ) ? 0 : ($roles->currentPage() - 1) * $roles->perPage() + 1;
            $end = min($roles->currentPage() * $roles->perPage(), $roles->total());
            @endphp
            Mostrando {{ $start }} a {{ $end }} de un total de {{
            \Illuminate\Support\Number::format($roles->total()) }} registros
        </div>

        <div class="text-sm text-gray-700">
            Página actual: {{ $roles->currentPage() }} de {{ $roles->lastPage() }}
        </div>

        {{ $roles->links('livewire.pagination.short-pagination') }}
    </div>
</div>
