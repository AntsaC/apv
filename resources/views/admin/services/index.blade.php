<x-admin.layout>
    <x-slot name="title">
        Liste des services
    </x-slot>

    <div>
        <div class="flex items-center justify-between mb-4 gap-4">
            <div class="flex items-center gap-2">
                <x-button :href="route('admin.services.create')" :type="'link'">Nouveau</x-button>
            </div>

            <form method="GET" action="{{ route('admin.services.index') }}" class="flex items-center gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Rechercher..."
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    <i class="fa fa-search"></i> Rechercher
                </button>
                @if($search)
                    <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">
                        <i class="fa fa-times"></i> Réinitialiser
                    </a>
                @endif
            </form>
        </div>

        <x-table :columns="[
            'name' => 'Nom',
            'vehicle.immatriculation' => 'Véhicule',
            'service_type' => 'Type',
            'price' => 'Prix (€)',
            'service_date' => 'Date'
        ]" :data="$services" :model="'services'" />

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
</x-admin.layout>
