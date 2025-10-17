<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h3 class="text-lg font-medium text-gray-700">Total Clients</h3>
                    <p class="text-3xl font-semibold text-gray-900">{{ $customersTotal }}</p>
                </div>

                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h3 class="text-lg font-medium text-gray-700">Total Vehicules</h3>
                    <p class="text-3xl font-semibold text-gray-900">{{ $vehiclesTotal }}</p>
                </div>

                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h3 class="text-lg font-medium text-gray-700">Gain Total</h3>
                    <p class="text-3xl font-semibold text-green-600">{{ number_format($totalGain, 2) }} €</p>
                </div>

            </div>

            <div class="bg-white p-6 shadow-md rounded-lg">
                <div class="mb-6 flex flex-wrap items-center gap-4">
                    <h3 class="text-lg font-semibold text-gray-800">Gains Quotidiens</h3>

                    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-3 ml-auto">
                        <div class="flex items-center gap-2">
                            <label for="month" class="text-sm font-medium text-gray-700">Mois:</label>
                            <select name="month" id="month" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="1" {{ $selectedMonth == 1 ? 'selected' : '' }}>Janvier</option>
                                <option value="2" {{ $selectedMonth == 2 ? 'selected' : '' }}>Février</option>
                                <option value="3" {{ $selectedMonth == 3 ? 'selected' : '' }}>Mars</option>
                                <option value="4" {{ $selectedMonth == 4 ? 'selected' : '' }}>Avril</option>
                                <option value="5" {{ $selectedMonth == 5 ? 'selected' : '' }}>Mai</option>
                                <option value="6" {{ $selectedMonth == 6 ? 'selected' : '' }}>Juin</option>
                                <option value="7" {{ $selectedMonth == 7 ? 'selected' : '' }}>Juillet</option>
                                <option value="8" {{ $selectedMonth == 8 ? 'selected' : '' }}>Août</option>
                                <option value="9" {{ $selectedMonth == 9 ? 'selected' : '' }}>Septembre</option>
                                <option value="10" {{ $selectedMonth == 10 ? 'selected' : '' }}>Octobre</option>
                                <option value="11" {{ $selectedMonth == 11 ? 'selected' : '' }}>Novembre</option>
                                <option value="12" {{ $selectedMonth == 12 ? 'selected' : '' }}>Décembre</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-2">
                            <label for="year" class="text-sm font-medium text-gray-700">Année:</label>
                            <select name="year" id="year" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                            Filtrer
                        </button>
                    </form>
                </div>

                <div class="mb-4 p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-gray-600">Gain pour
                        @php
                            $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                        @endphp
                        <span class="font-semibold">{{ $months[$selectedMonth - 1] }} {{ $selectedYear }}</span>
                    </p>
                    <p class="text-2xl font-semibold text-green-600 mt-1">{{ number_format($selectedMonthGain, 2) }} €</p>
                </div>

                <div class="relative" style="height: 400px;">
                    <canvas id="dailyGainChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const dailyCtx = document.getElementById('dailyGainChart').getContext('2d');
        const dailyChart = new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: {!! $dailyLabels !!},
                datasets: [{
                    label: 'Gain Quotidien (€)',
                    data: {!! $dailyData !!},
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toFixed(2) + ' €';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toFixed(2) + ' €';
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
