<x-admin.layout>
    <x-slot name="title">
        {{ $service->id ? 'Modifier le service' : 'Ajouter un Service'}}
    </x-slot>

    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <form action="{{ $service->id ? route('admin.services.update', $service->id) : route('admin.services.store') }}" method="POST" class="space-y-6">
            @if ($service->id)
                @method('PUT')
            @endif
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-select name="vehicle_id" label="Véhicule" required>
                    <option value="">-- Sélectionner un véhicule --</option>
                    @foreach ( $vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $service->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->immatriculation }} - {{ $vehicle->brand }} {{ $vehicle->model }}
                        </option>
                    @endforeach
                </x-select>

                <x-text-input :name="'name'" label="Nom du service" :value="old('name', $service->name)" required />

                <x-text-input :name="'service_type'" label="Type de service" :value="old('service_type', $service->service_type)" />

                <x-text-input :name="'price'" type="number" step="0.01" label="Prix (€)" :value="old('price', $service->price)" required />

                <x-text-input :name="'service_date'" type="date" label="Date du service" :value="old('service_date', $service->service_date)" required />
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    {{ $service->id ? 'Modifier le service' : 'Ajouter le Service' }}
                </button>
            </div>
        </form>
    </div>
</x-admin.layout>
