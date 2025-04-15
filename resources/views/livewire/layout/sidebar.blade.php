<div>
    <div x-show="open" class="relative z-50 lg:hidden"
        x-description="Off-canvas menu for mobile, show/hide based on off-canvas menu state." x-ref="dialog"
        aria-modal="true" style="display: none;">

        <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80"
            x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state." aria-hidden="true"
            style="display: none;"></div>


        <div class="fixed inset-0 flex">

            <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                class="relative flex flex-1 w-full max-w-xs mr-16" @click.away="open = false" style="display: none;">

                <div x-show="open" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    x-description="Close button, show/hide based on off-canvas menu state."
                    class="absolute top-0 flex justify-center w-16 pt-5 left-full" style="display: none;">
                    <button type="button" class="-m-2.5 p-2.5" @click="open = false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col px-6 pb-4 overflow-y-auto bg-white grow gap-y-5">
                    <div class="flex items-center h-16 shrink-0">
                        <img class="w-auto h-16" {{--
                            src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&amp;shade=600" --}}
                            src="{{ asset('images/Azul_SM.png') }}" alt="Glasswing">
                    </div>
                    <nav class="flex flex-col flex-1">
                        <ul role="list" class="flex flex-col flex-1 gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="/admin/dashboard" {{--
                                            class="flex p-2 text-sm font-semibold leading-6 text-indigo-600 rounded-md bg-gray-50 group gap-x-3"
                                            --}} wire:navigate @class([ 'text-indigo-600 bg-gray-50'=>
                                            Route::currentRouteName() === 'dashboard',
                                            'text-gray-700' => Route::currentRouteName() !== 'dashboard',
                                            'flex p-2 text-sm font-semibold leading-6 hover:bg-gray-50 group gap-x-3
                                            hover:text-indigo-600'
                                            ])
                                            x-state:on="Current" x-state:off="Default">
                                            <svg @class([ 'text-indigo-600'=> Route::currentRouteName() === 'dashboard',
                                                'text-gray-400 group-hover:text-indigo-600' => Route::currentRouteName()
                                                !== 'dashboard',
                                                'w-6 h-6 shrink-0'
                                                ])
                                                fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                                data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25">
                                                </path>
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>

                                    @if (auth()->user()->can('Ver inscripción formaciones SM'))
                                    <li>
                                        <a href="{{ route('admin.inscripcion.index') }}" wire:navigate
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                            x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                            <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75">
                                                </path>
                                            </svg>
                                            Inscripción formaciones SM
                                        </a>
                                    </li>
                                    @endif
                                    @if (auth()->user()->can('Ver seguimientos FGSM'))
                                    <li>
                                        <a href="{{ route('admin.seguimiento.index') }}" wire:navigate
                                            @class([ 'text-indigo-600 bg-gray-50'=> Route::currentRouteName() ===
                                            'admin.seguimiento.index',
                                            'text-gray-700' => Route::currentRouteName() !== 'admin.seguimiento.index',
                                            'flex p-2 text-sm font-semibold leading-6 hover:bg-gray-50 group gap-x-3
                                            hover:text-indigo-600'
                                            ])
                                            >
                                            <svg @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                                'admin.seguimiento.index',
                                                'text-gray-400 group-hover:text-indigo-600' => Route::currentRouteName()
                                                !== 'admin.seguimiento.index',
                                                'w-6 h-6 shrink-0'
                                                ])
                                                fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true"
                                                data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z">
                                                </path>
                                            </svg>
                                            Seguimientos FGSM
                                        </a>
                                    </li>
                                    @endif

                                    @if (auth()->user()->can('Ver intervenciones directas SM'))
                                    <li>
                                        <a href="{{ route('admin.intervenciones.index') }}" wire:navigate
                                            @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                            'admin.intervenciones.index',
                                            'text-gray-700' => Route::currentRouteName() !==
                                            'admin.intervenciones.index',
                                            'flex p-2 text-sm font-semibold leading-6 hover:bg-gray-50 group gap-x-3
                                            hover:text-indigo-600'
                                            ])
                                            x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;,
                                            undefined: &quot;text-gray-700 hover:text-indigo-600
                                            hover:bg-gray-50&quot;">
                                            <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z">
                                                </path>
                                            </svg>
                                            Intervenciones directas SM
                                        </a>
                                    </li>
                                    @endif

                                    @if (auth()->user()->can('Ver referencias RSAC'))
                                    <li>

                                        <div
                                            x-data="{ open: {{ in_array(Route::currentRouteName(), ['admin.frp.index', 'admin.FRP.editar', 'admin.FRP.seguimiento']) ? 'true' : 'false' }} }">
                                            <button type="button"
                                                class="flex items-center w-full p-2 font-semibold text-left text-gray-700 rounded-md hover:bg-gray-50 gap-x-3 text-sm/6"
                                                aria-controls="sub-menu-1" @click="open = !open" aria-expanded="true"
                                                x-bind:aria-expanded="open.toString()">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                                </svg>
                                                Referencia RSAC
                                                <svg class="w-5 h-5 ml-auto text-gray-500 rotate-90 shrink-0"
                                                    x-state:on="Expanded" x-state:off="Collapsed"
                                                    :class="{ 'rotate-90 text-gray-500': open, 'text-gray-400': !(open) }"
                                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                                    data-slot="icon">
                                                    <path fill-rule="evenodd"
                                                        d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                            <ul class="px-2 mt-1" id="sub-menu-1" x-show="open">
                                                <li>
                                                    <a href="{{ route('admin.frp.index', ['edad' => 'mayor']); }}"
                                                        @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                                        'admin.frp.index' && request('edad') === 'mayor' ,
                                                        'text-gray-700' => Route::currentRouteName() !==
                                                        'admin.frp.index' && request('edad') === 'mayor' ,
                                                        'hover:bg-gray-50 block rounded-md py-2 pr-2 pl-9 text-sm/6
                                                        text-gray-700 flex'
                                                        ])
                                                        >
                                                        <svg class="w-6 h-6 mr-2 text-gray-400 shrink-0"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                        </svg>
                                                        Mayores de Edad
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.frp.index', ['edad' => 'menor']); }}"
                                                        @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                                        'admin.frp.index' && request('edad') === 'menor' ,
                                                        'text-gray-700' => Route::currentRouteName() !==
                                                        'admin.frp.index' && request('edad') === 'menor' ,
                                                        'hover:bg-gray-50 block rounded-md py-2 pr-2 pl-9 text-sm/6
                                                        text-gray-700 flex'
                                                        ])
                                                        >
                                                        <svg class="w-6 h-6 mr-2 text-gray-400 shrink-0"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                        </svg>
                                                        Menores de Edad
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    @endif
                                    @if (auth()->user()->can('Ver registros club NNA'))
                                    <li>
                                        <a href="{{ route('club-nna.index') }}" wire:navigate
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                            x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                            <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true" data-slot="icon">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75">
                                                </path>
                                            </svg>
                                            Club NNA
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>

                            <li>
                                <div class="text-xs font-semibold leading-6 text-gray-400">Herramientas</div>
                                <ul role="list" class="mt-2 -mx-2 space-y-1">
                                    <li>
                                        <a href="{{ route('admin.buscador-personas.index') }}" wire:navigate
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                            x-state:on="Current" x-state:off="Default"
                                            x-state-description="Current: &quot;bg-gray-50 text-indigo-600&quot;, Default: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                            <span
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">B</span>
                                            <span class="truncate">Buscador de personas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            @if(auth()->user()->can('Ver usuarios') ||
                            auth()->user()->can('Ver roles') ||
                            auth()->user()->can('Ver permisos')
                            )
                            <li>
                                <div class="text-xs font-semibold leading-6 text-gray-400">Administración del sistema
                                </div>
                                <ul role="list" class="mt-2 -mx-2 space-y-1">
                                    @if(auth()->user()->can('Ver usuarios'))
                                    <li>
                                        <a href="{{ route('admin.users.index') }}" wire:navigate
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                            x-state:on="Current" x-state:off="Default"
                                            x-state-description="Current: &quot;bg-gray-50 text-indigo-600&quot;, Default: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                            <span
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">U</span>
                                            <span class="truncate">Usuarios</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(auth()->user()->can('Ver roles'))
                                    <li>
                                        <a href="{{ route('admin.roles') }}" wire:navigate
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                            x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                            <span
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">R</span>
                                            <span class="truncate">Roles</span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(auth()->user()->can('Ver permisos'))
                                    <li>
                                        <a href="{{ route('admin.permisos') }}" wire:navigate
                                            class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                            x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                            <span
                                                class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">P</span>
                                            <span class="truncate">Permisos</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>


    <!-- Static sidebar for desktop -->
    <div x-show="openMenu" {{-- x-transition:enter="transition-opacity ease-linear duration-300" --}}
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" {{--
        x-transition:leave="transition-opacity ease-linear duration-300" --}} {{--
        x-transition:leave-start="opacity-100" --}} x-transition:leave-end="opacity-0"
        x-description="Off-canvas menu backdrop, show/hide based on off-canvas menu state." aria-hidden="true"
        class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex flex-col px-6 pb-4 overflow-y-auto bg-white border-r border-gray-200 grow gap-y-5">
            <div class="flex items-center h-16 shrink-0">
                <a href="/admin/dashboard" wire:navigate>
                    <div class="flex flex-col items-center justify-between sm:flex-row">
                        <div class="flex w-full sm:w-1/2">
                            <img src="{{ asset('images/Azul_SM.png') }}" alt="Azul SM" class="w-full">
                        </div>
                        {{-- <div class="flex w-full sm:w-1/2">
                            <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-full">
                        </div> --}}
                    </div>
                </a>
            </div>
            {{-- <div class="flex items-center h-16 shrink-0">
                <img class="w-auto h-8" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&amp;shade=600"
                    alt="Your Company">
            </div> --}}
            <nav class="flex flex-col flex-1">
                <ul role="list" class="flex flex-col flex-1 gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" wire:navigate {{--
                                    class="flex p-2 text-sm font-semibold leading-6 text-indigo-600 rounded-md bg-gray-50 group gap-x-3"
                                    --}} @class([ 'text-indigo-600 bg-gray-50'=> Route::currentRouteName() ===
                                    'dashboard',
                                    'text-gray-700' => Route::currentRouteName() !== 'dashboard',
                                    'flex p-2 text-sm font-semibold leading-6 hover:bg-gray-50 group gap-x-3
                                    hover:text-indigo-600'
                                    ])
                                    x-state:on="Current" x-state:off="Default">
                                    <svg @class([ 'text-indigo-600'=> Route::currentRouteName() === 'dashboard',
                                        'text-gray-400 group-hover:text-indigo-600' => Route::currentRouteName() !==
                                        'dashboard',
                                        'w-6 h-6 shrink-0'
                                        ])
                                        fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25">
                                        </path>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>

                            <!-- Inscripción formaciones SM -->
                            @if (auth()->user()->can('Ver inscripción formaciones SM'))
                            <li>
                                <a href="{{ route('admin.inscripcion.index') }}" wire:navigate
                                    @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                    'admin.inscripcion.index',
                                    'text-gray-700' => Route::currentRouteName() !== 'admin.inscripcion.index',
                                    'flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md
                                    hover:text-indigo-600 hover:bg-gray-50 group gap-x-3'
                                    ])

                                    >
                                    <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75">
                                        </path>
                                    </svg>
                                    Inscripción formaciones SM
                                </a>
                            </li>
                            @endif
                            <!-- Seguimientos FGSM -->
                            @if (auth()->user()->can('Ver seguimientos FGSM'))
                            <li>
                                <a href="{{ route('admin.seguimiento.index') }}" wire:navigate
                                    @class([ 'text-indigo-600 bg-gray-50'=> Route::currentRouteName() ===
                                    'admin.seguimiento.index',
                                    'text-gray-700' => Route::currentRouteName() !== 'admin.seguimiento.index',
                                    'flex p-2 text-sm font-semibold leading-6 hover:bg-gray-50 group gap-x-3
                                    hover:text-indigo-600'
                                    ])
                                    >
                                    <svg @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                        'admin.seguimiento.index',
                                        'text-gray-400 group-hover:text-indigo-600' => Route::currentRouteName() !==
                                        'admin.seguimiento.index',
                                        'w-6 h-6 shrink-0'
                                        ])
                                        fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z">
                                        </path>
                                    </svg>
                                    Seguimientos FGSM
                                </a>
                            </li>
                            @endif

                            @if (auth()->user()->can('Ver intervenciones directas SM'))
                            <li>
                                <a href="{{ route('admin.intervenciones.index') }}" wire:navigate
                                    @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                    'admin.intervenciones.index',
                                    'text-gray-700' => Route::currentRouteName() !== 'admin.intervenciones.index',
                                    'flex p-2 text-sm font-semibold leading-6 hover:bg-gray-50 group gap-x-3
                                    hover:text-indigo-600'
                                    ])
                                    x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined:
                                    &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                    <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z">
                                        </path>
                                    </svg>
                                    Intervenciones directas SM
                                </a>
                            </li>
                            @endif

                            @if (auth()->user()->can('Ver referencias RSAC'))
                            <li>

                                <div
                                    x-data="{ open: {{ in_array(Route::currentRouteName(), ['admin.frp.index', 'admin.FRP.editar', 'admin.FRP.seguimiento']) ? 'true' : 'false' }} }">
                                    <button type="button"
                                        class="flex items-center w-full p-2 font-semibold text-left text-gray-700 rounded-md hover:bg-gray-50 gap-x-3 text-sm/6"
                                        aria-controls="sub-menu-1" @click="open = !open" aria-expanded="true"
                                        x-bind:aria-expanded="open.toString()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                        </svg>
                                        Referencia RSAC
                                        <svg class="w-5 h-5 ml-auto text-gray-500 rotate-90 shrink-0"
                                            x-state:on="Expanded" x-state:off="Collapsed"
                                            :class="{ 'rotate-90 text-gray-500': open, 'text-gray-400': !(open) }"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd"
                                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <ul class="px-2 mt-1" id="sub-menu-1" x-show="open">
                                        <li>
                                            <a href="{{ route('admin.frp.index', ['edad' => 'mayor']); }}"
                                                @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                                'admin.frp.index' && request('edad') === 'mayor' ,
                                                'text-gray-700' => Route::currentRouteName() !== 'admin.frp.index' &&
                                                request('edad') === 'mayor' ,
                                                'hover:bg-gray-50 block rounded-md py-2 pr-2 pl-9 text-sm/6
                                                text-gray-700 flex'
                                                ])
                                                >
                                                <svg class="w-6 h-6 mr-2 text-gray-400 shrink-0"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                </svg>
                                                Mayores de Edad
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.frp.index', ['edad' => 'menor']); }}"
                                                @class([ 'text-indigo-600'=> Route::currentRouteName() ===
                                                'admin.frp.index' && request('edad') === 'menor' ,
                                                'text-gray-700' => Route::currentRouteName() !== 'admin.frp.index' &&
                                                request('edad') === 'menor' ,
                                                'hover:bg-gray-50 block rounded-md py-2 pr-2 pl-9 text-sm/6
                                                text-gray-700 flex'
                                                ])
                                                >
                                                <svg class="w-6 h-6 mr-2 text-gray-400 shrink-0"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                </svg>
                                                Menores de Edad
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif
                            @if (auth()->user()->can('Ver registros club NNA'))
                            <li>
                                <a href="{{ route('club-nna.index') }}" wire:navigate @class([ 'text-indigo-600'=>
                                    Route::currentRouteName() === 'club-nna.index',
                                    'text-gray-700' => Route::currentRouteName() !== 'club-nna.index',
                                    'flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md
                                    hover:text-indigo-600 hover:bg-gray-50 group gap-x-3'
                                    ])
                                    x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined:
                                    &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                    <svg class="w-6 h-6 text-gray-400 shrink-0 group-hover:text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                        data-slot="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75">
                                        </path>
                                    </svg>
                                    Club NNA
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>

                    <li>
                        <div class="text-xs font-semibold leading-6 text-gray-400">Herramientas</div>
                        <ul role="list" class="mt-2 -mx-2 space-y-1">
                            <li>
                                <a href="{{ route('admin.buscador-personas.index') }}" wire:navigate
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                    x-state:on="Current" x-state:off="Default"
                                    x-state-description="Current: &quot;bg-gray-50 text-indigo-600&quot;, Default: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                    <span
                                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">B</span>
                                    <span class="truncate">Buscador de personas</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    @if(auth()->user()->can('Ver usuarios') ||
                    auth()->user()->can('Ver roles') ||
                    auth()->user()->can('Ver permisos'))
                    <li>
                        <div class="text-xs font-semibold leading-6 text-gray-400">Administración del sistema</div>
                        <ul role="list" class="mt-2 -mx-2 space-y-1">
                            @if(auth()->user()->can('Ver usuarios'))
                            <li>
                                <a href="{{ route('admin.users.index') }}" wire:navigate
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                    x-state:on="Current" x-state:off="Default"
                                    x-state-description="Current: &quot;bg-gray-50 text-indigo-600&quot;, Default: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                    <span
                                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">U</span>
                                    <span class="truncate">Usuarios</span>
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->can('Ver roles'))
                            <li>
                                <a href="{{ route('admin.roles') }}" wire:navigate
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                    x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                    <span
                                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">R</span>
                                    <span class="truncate">Roles</span>
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->can('Ver permisos'))
                            <li>
                                <a href="{{ route('admin.permisos') }}" wire:navigate
                                    class="flex p-2 text-sm font-semibold leading-6 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50 group gap-x-3"
                                    x-state-description="undefined: &quot;bg-gray-50 text-indigo-600&quot;, undefined: &quot;text-gray-700 hover:text-indigo-600 hover:bg-gray-50&quot;">
                                    <span
                                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border text-[0.625rem] font-medium bg-white text-gray-400 border-gray-200 group-hover:border-indigo-600 group-hover:text-indigo-600">P</span>
                                    <span class="truncate">Permisos</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>



</div>
