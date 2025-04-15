<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2"></div>
                    <a href="/pais/guatemala/formacion-general" class="block p-6 bg-blue-100 rounded-lg shadow-md hover:bg-blue-200">
                        <h3 class="text-lg font-semibold text-blue-800">Seguimiento formación general</h3>
                        {{-- <p class="mt-2 text-blue-600">Description for the first card.</p> --}}
                    </a>
                    <a href="/pais/guatemala/intervenciones" class="block p-6 bg-green-100 rounded-lg shadow-md hover:bg-green-200">
                        <h3 class="text-lg font-semibold text-green-800"> Registro de intervenciones directas</h3>
                        {{-- <p class="mt-2 text-green-600">Description for the second card.</p> --}}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
