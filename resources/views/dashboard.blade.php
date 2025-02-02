<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                
                <!-- Total Customers Card -->
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h3 class="text-lg font-medium text-gray-700">Total Clients</h3>
                    <p class="text-3xl font-semibold text-gray-900">{{ $customersTotal }}</p>
                </div>

                <!-- Total Vehicles Card -->
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <h3 class="text-lg font-medium text-gray-700">Total Vehicules</h3>
                    <p class="text-3xl font-semibold text-gray-900">{{ $vehiclesTotal }}</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
