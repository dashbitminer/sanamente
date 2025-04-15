<div>


    <div x-data="{ open: false }">

        <button type="button" x-show="!open" @click="open = !open" x-popover:button=""
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg"
            id="alpine-popover-button-1" aria-expanded="false">
            <div>
                Mostrar gráfico
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
            </svg>
        </button>

        <button type="button" x-show="open" @click="open = !open" x-popover:button=""
            class="flex items-center gap-2 py-1 pl-3 pr-2 text-sm text-gray-600 border rounded-lg"
            id="alpine-popover-button-1" aria-expanded="false">
            <div>
                Ocultar gráfico
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 15.75l7.5-7.5 7.5 7.5"></path>
            </svg>
        </button>

        <div x-show="open" class="my-6">
            <div x-data="chartData()">
                <div id="chart">
                    <canvas id="barChart" width="800" height="450"></canvas>
                </div>
                <script>
                    function chartData() {
                        return {
                            actividades: @json($actividades),
                            init() {
                                const labels = this.actividades.map(a => a.nombre);
                                const data = this.actividades.map(a => a.total_records);
                                const colors = [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(199, 199, 199, 0.2)',
                                    'rgba(83, 102, 255, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)'
                                ];
                                const borderColors = [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(199, 199, 199, 1)',
                                    'rgba(83, 102, 255, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)'
                                ];
                                const ctx = document.getElementById('barChart').getContext('2d');
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Total',
                                            data: data,
                                            backgroundColor: colors,
                                            borderColor: borderColors,
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                                onClick: (e, legendItem) => {
                                                    const index = legendItem.datasetIndex;
                                                    const ci = e.chart;
                                                    const meta = ci.getDatasetMeta(index);
                                                    meta.hidden = meta.hidden === null ? !ci.data.datasets[index].hidden : null;
                                                    ci.update();
                                                }
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    }
                </script>

            </div>
        </div>
    </div>

    @php
    // 'menta': '#ACDCC2',
    // 'zafiro': '#D6DBFF',
    // 'blanco-nieve': '#ECF5F1 ',
    // 'azul-glasswing': '#0092A0',
    // 'dark-gray': '#111613',
    // 'dark-green': '#566E61'
    $colors = [
    // '#ACDCC2',
    // '#D6DBFF',
    // '#0092A0',
    // '#111613',
    // '#566E61',
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64)',
    'rgba(199, 199, 199)',
    'rgba(83, 102, 255)',
    'rgba(255, 99, 132)',
    'rgba(54, 162, 235)'
    ];
    @endphp


    <div class="p-4 mt-4 bg-gray-100 rounded-lg">
        <div class="grid grid-cols-1 gap-4 my-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
            @foreach ($actividades as $key => $actividad)
            <div class="flex flex-col items-center justify-center p-4 bg-white rounded-lg shadow">
                <h2 class="font-semibold text-center text-md" style="color:{{ $colors[$key] }} !important">{{
                    $actividad->nombre }}</h2>
                <p class="mt-2 text-2xl font-bold text-gray-600"> {{ array_sum($actividad->total_perfiles_count) }}</p>
            </div>
            @endforeach
        </div>
    </div>



    <div class="flex flex-col col-span-5 gap-2 mt-8 mb-4 sm:flex-row sm:justify-end">

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

                    <svg class="w-4 h-4 text-white animate-spin" wire:loading="" wire:target="export"
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

    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full mt-8 divide-y divide-gray-300 shadow-lg">
            <thead>
                <tr class="border border-gray-300 divide-x divide-gray-300 bg-azul-glasswing">
                    <th scope="col"
                        class="py-3.5 sm:pl-4 pl-0 pr-4 text-left text-sm font-semibold text-white w-2/5 uppercase">
                        Actividad
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-center text-sm font-semibold text-white w-1/12 uppercase">
                        Cantidad de grupos
                    </th>
                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-white w-1/4 uppercase">
                        Perfil</th>
                    <th scope="col" class="px-4 py-3.5 text-center text-sm font-semibold text-white w-1/12 uppercase">
                        Total participantes únicos</th>
                    <th scope="col" class="px-4 py-3.5 text-center text-sm font-semibold text-white w-1/12 uppercase">
                        Total participaciones</th>
                    <th scope="col"
                        class="py-3.5 pl-4 pr-4 text-sm font-semibold text-white sm:pr-0 w-1/12 text-center uppercase">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($actividades as $actividad)
                <tr class="border border-gray-300 divide-x divide-gray-300">
                    <td class="py-4 pl-0 text-sm font-medium text-gray-900 border border-gray-300 sm:px-4 whitespace-nowrap "
                        rowspan="{{ count($actividad->total_perfiles_count) }}">
                        {{ $actividad->nombre }}</td>
                    <td class="p-4 text-sm text-center text-gray-800 border border-gray-300 whitespace-nowrap"
                        rowspan="{{ count($actividad->total_perfiles_count)}}">{{ $actividad->unique_grupo_count }}</td>

                    @foreach ($actividad->total_perfiles_count as $key => $value)
                    @if ($loop->first)
                    <td class="p-4 text-sm text-gray-800 border border-gray-300 whitespace-nowrap">{{ $key }}</td>
                    <td class="p-4 text-sm text-center text-gray-800 border border-gray-300 whitespace-nowrap">
                        {{ count(array_filter($actividad->unique_perfiles_count, function($perfil) use ($key) {
                        return $perfil['nombre'] === $key;
                        })) }}
                    </td>
                    <td class="p-4 text-sm text-center text-gray-800 border border-gray-300 whitespace-nowrap">{{ $value
                        }}</td>
                    <td class="w-1/12 py-4 pl-4 pr-4 font-bold text-center text-gray-800 border border-gray-300 text-md whitespace-nowrap sm:pr-0"
                        rowspan="{{ count($actividad->total_perfiles_count) }}">
                        {{ array_sum($actividad->total_perfiles_count) }}
                    </td>
                </tr>
                @else
                <tr class="border border-gray-300 divide-x divide-gray-200">
                    <td class="p-4 text-sm text-gray-800 border border-gray-300 whitespace-nowrap">{{ $key }}</td>
                    <td class="p-4 text-sm text-center text-gray-800 border border-gray-300 whitespace-nowrap">
                        {{ count(array_filter($actividad->unique_perfiles_count, function($perfil) use ($key) {
                        return $perfil['nombre'] === $key;
                        })) }}
                    </td>
                    <td class="p-4 text-sm text-center text-gray-800 border border-gray-300 whitespace-nowrap">{{ $value
                        }}</td>
                </tr>
                @endif
                @endforeach
                @endforeach
                <!-- More people... -->
            </tbody>
        </table>
    </div>


</div>
