<div>
    {{-- Participantes unicos
    Total Participanciones --}}
    <!-- Tabs -->
    <div x-data="{
        selectedId: null,
        init() {
            // Set the first available tab on the page on page load.
            this.$nextTick(() => this.select(this.$id('tab', 1)))
        },
        select(id) {
            this.selectedId = id
        },
        isSelected(id) {
            return this.selectedId === id
        },
        whichChild(el, parent) {
            return Array.from(parent.children).indexOf(el) + 1
        }
    }" x-id="['tab']" class="py-6 overflow-hidden shadow-sm sm:rounded-lg">
        <!-- Tab List -->
        <ul x-ref="tablist" @keydown.right.prevent.stop="$focus.wrap().next()"
            @keydown.home.prevent.stop="$focus.first()" @keydown.page-up.prevent.stop="$focus.first()"
            @keydown.left.prevent.stop="$focus.wrap().prev()" @keydown.end.prevent.stop="$focus.last()"
            @keydown.page-down.prevent.stop="$focus.last()" role="tablist"
            class="flex items-stretch -mb-px overflow-x-auto">
            <!-- Tab -->
            @if (auth()->user()->can('Ver seguimientos FGSM'))
            <li>
                <button :id="$id('tab', whichChild($el.parentElement, $refs.tablist))" @click="select($el.id)"
                    @mousedown.prevent @focus="select($el.id)" type="button" :tabindex="isSelected($el.id) ? 0 : -1"
                    :aria-selected="isSelected($el.id)"
                    :class="isSelected($el.id) ? 'border-gray-200 bg-white' : 'border-transparent'"
                    class="inline-flex rounded-t-lg border-t border-l border-r px-5 py-2.5"
                    role="tab">Registros</button>
            </li>
            @endif
            @if (auth()->user()->can('Resumen de ejecución por actividad'))
            <li>
                <button :id="$id('tab', whichChild($el.parentElement, $refs.tablist))" @click="select($el.id)"
                    @mousedown.prevent @focus="select($el.id)" type="button" :tabindex="isSelected($el.id) ? 0 : -1"
                    :aria-selected="isSelected($el.id)"
                    :class="isSelected($el.id) ? 'border-gray-200 bg-white' : 'border-transparent'"
                    class="inline-flex rounded-t-lg border-t border-l border-r px-5 py-2.5" role="tab">Resumen de
                    ejecución por actividad</button>
            </li>
            @endif
            @if (auth()->user()->can('Resumen de ejecución por persona única'))
            <li>
                <button :id="$id('tab', whichChild($el.parentElement, $refs.tablist))" @click="select($el.id)"
                    @mousedown.prevent @focus="select($el.id)" type="button" :tabindex="isSelected($el.id) ? 0 : -1"
                    :aria-selected="isSelected($el.id)"
                    :class="isSelected($el.id) ? 'border-gray-200 bg-white' : 'border-transparent'"
                    class="inline-flex rounded-t-lg border-t border-l border-r px-5 py-2.5" role="tab">Resumen de
                    ejecución por persona única</button>
            </li>
            @endif
        </ul>

        <!-- Panels -->
        <div role="tabpanels" class="bg-white border border-gray-200 rounded-b-lg rounded-tr-lg">
            <!-- Panel -->
            <section x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))" role="tabpanel" class="p-8">

                <div class="px-4 sm:px-3 lg:px-4">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Seguimiento de formación general
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                Formularios de inscripción y asistencia.</p>
                        </div>
                        <div
                            x-data="{ showTooltip: false, showTooltipPolicia: false, url: '{{ route('seguimiento.create', [$pais, auth()->user()->uuid, auth()->user()->email]) }}', urlPolicia: '{{ route('seguimiento.create.policia', [$pais, auth()->user()->uuid, auth()->user()->email]) }}' }">

                            <div class="flex justify-end mt-4 text-sm sm:ml-16 sm:mt-0 sm:flex-none">

                                <div x-show="showTooltip" class="px-2 py-2 tooltip show ">
                                    Enlace copiado
                                </div>

                                <div class="relative">
                                    <a href="#" role="button"
                                        x-on:click="navigator.clipboard.writeText(url); showTooltip = true; setTimeout(() => showTooltip = false, 2000)"
                                        class="inline-flex items-center px-2 py-2 font-medium text-indigo-600 group hover:text-indigo-900">
                                        <svg class="text-indigo-500 size-5 group-hover:text-indigo-900"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path
                                                d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z">
                                            </path>
                                            <path
                                                d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z">
                                            </path>
                                        </svg>
                                        <span class="ml-2">Copiar Enlace</span>
                                    </a>

                                </div>


                                <a href="{{ route('seguimiento.create', [$pais, auth()->user()->uuid, auth()->user()->email]) }}"
                                    wire:navigate role="button"
                                    class="block px-2 py-2 text-sm font-semibold text-center text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Registrar participante
                                </a>



                            </div>

                            @if ($pais->id == 2)
                            <div class="flex justify-end mt-5 text-sm sm:ml-16 sm:flex-none">

                                <div x-show="showTooltipPolicia" class="px-2 py-2 tooltip show ">
                                    Enlace copiado
                                </div>

                                <div class="relative">
                                    <a href="#" role="button"
                                        x-on:click="navigator.clipboard.writeText(urlPolicia); showTooltipPolicia = true; setTimeout(() => showTooltipPolicia = false, 2000)"
                                        class="inline-flex items-center px-3 py-2 font-medium text-sky-600 group hover:text-sky-900">
                                        <svg class="text-sky-500 size-5 group-hover:text-sky-900" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path
                                                d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z">
                                            </path>
                                            <path
                                                d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z">
                                            </path>
                                        </svg>
                                        <span class="ml-2">Copiar Enlace</span>
                                    </a>

                                </div>

                                <a href="{{ route('seguimiento.create.policia', [$pais, auth()->user()->uuid, auth()->user()->email]) }}"
                                    wire:navigate role="button"
                                    class="block px-2 py-2 ml-4 text-sm font-semibold text-center text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                                    Registrar participante policia
                                </a>
                            </div>
                            @endif

                        </div>

                    </div>

                    <div
                        class="flex flex-col items-start justify-start gap-4 mt-4 sm:flex-row sm:justify-between sm:items-center">
                        <div class="flex flex-col gap-1"></div>
                        <div class="flex gap-2">
                            {{--
                            <x-participante.index.filter-participantes :$filters /> --}}

                            {{--
                            <x-common.filter-range :$filters /> --}}
                        </div>
                    </div>

                    <div class="my-2">
                        {{--
                        <x-participante.index.filter-status :$filters /> --}}


                    </div>

                    <livewire:FGSM.index.table :$filters :$pais />

                </div>

            </section>
            @if (auth()->user()->can('Resumen de ejecución por actividad'))
            <section x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))" role="tabpanel" class="p-8">
                {{-- <h2 class="text-xl font-bold">Tab 2 Content</h2>
                <p class="mt-2 text-gray-500">Fugiat odit alias, eaque optio quas nobis minima reiciendis voluptate
                    dolorem nisi facere debitis ea laboriosam vitae omnis ut voluptatum eos. Fugiat?</p>
                <button class="px-4 py-2 mt-5 text-sm text-gray-800 border border-gray-200 rounded-lg">Something else
                    focusable</button> --}}


                <livewire:FGSM.index.ejecucion-por-actividad />


            </section>
            @endif

            @if (auth()->user()->can('Resumen de ejecución por persona única'))
            <section x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))" role="tabpanel" class="p-8">
                {{-- <h2 class="text-xl font-bold">Tab 3 Content</h2>
                <p class="mt-2 text-gray-500">Fugiat odit alias, eaque optio quas nobis minima reiciendis voluptate
                    dolorem nisi facere debitis ea laboriosam vitae omnis ut voluptatum eos. Fugiat?</p>
                <button class="px-4 py-2 mt-5 text-sm text-gray-800 border border-gray-200 rounded-lg">Something else
                    focusable</button> --}}

                <livewire:FGSM.index.ejecucion-por-persona />

            </section>
            @endif
        </div>
    </div>

    {{-- <div class="py-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">




    </div> --}}

</div>