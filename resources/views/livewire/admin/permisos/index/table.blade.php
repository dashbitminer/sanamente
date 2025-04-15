<div class="flow-root mt-8">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="relative">
                <table class="min-w-full divide-y divide-gray-300 table-fixed">
                    <tr>
                        <th scope="col" class="w-1/6 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Nombre
                        </th>
                        @foreach ($roles as $role)
                            <th scope="col" class="w-[15%] px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                {{ $role->name }}
                            </th>
                        @endforeach
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(count($permissionCategories))
                            @foreach ($permissionCategories as $categoryData)
                                @if(!auth()->user()->hasRole('Super_Admin') && in_array($categoryData[0], ['Roles', 'Usuario', 'Permisos']))
                                    @continue
                                @endif
                                
                                @if($categoryData[0])
                                    <tr class="bg-gray bg-gray-50">
                                        <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="font-bold text-gray-900">{{ $categoryData[0] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="{{ count($roles) }}"></td>
                                        <td></td>
                                    </tr>
                                @endif
                                @foreach ($categoryData[1] as $permission)
                                    <tr wire:key='rand-{{ $permission->id }}'>
                                        <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ $permission->name }}</div>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($roles as $role)
                                            <td class="px-3 py-5 text-sm text-center text-gray-500 whitespace-nowrap">
                                                <input type="checkbox"
                                                    @if($canEdit) wire:change="togglePermission('{{ $permission->id }}', '{{ $role->id }}')" @endif
                                                    @checked($role->hasPermissionTo($permission))
                                                    @if(!$canEdit) disabled @endif
                                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                />
                                            </td>
                                        @endforeach
                                        <td class="relative py-5 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-0">
                                            <x-common.permission-row-dropdown :$permission wire:key='row-{{ $permission->id}}' />
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
