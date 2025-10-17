<x-admin.layout>
    <x-slot name="title">
        Détails du Service
    </x-slot>

    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">{{ $service->name }}</h2>
            <p class="text-gray-600 mt-2">{{ $service->service_type }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Véhicule</h3>
                <p class="mt-1 text-lg text-gray-900">
                    {{ $service->vehicle->immatriculation }} - {{ $service->vehicle->brand }} {{ $service->vehicle->model }}
                </p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500">Prix</h3>
                <p class="mt-1 text-lg font-semibold text-green-600">{{ number_format($service->price, 2) }} €</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500">Date du service</h3>
                <p class="mt-1 text-lg text-gray-900">{{ \Carbon\Carbon::parse($service->service_date)->format('d/m/Y') }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500">Date de création</h3>
                <p class="mt-1 text-lg text-gray-900">{{ $service->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        @if($service->description)
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-500">Description</h3>
                <p class="mt-2 text-gray-900">{{ $service->description }}</p>
            </div>
        @endif

        <div class="mt-8 flex gap-4">
            <x-button :href="route('admin.services.edit', $service->id)" :type="'link'">Modifier</x-button>
            <x-button :href="route('admin.services.index')" :type="'link'">Retour à la liste</x-button>
        </div>
    </div>
</x-admin.layout>
