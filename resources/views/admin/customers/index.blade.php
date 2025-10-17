<x-admin.layout>
    <x-slot name="title">
        Liste des clients
    </x-slot>

    <div>
        <div class="flex items-center justify-between mb-4 gap-4">
            <div class="flex items-center gap-2">
                <x-button :href="route('admin.customers.create')" :type="'link'">Nouveau</x-button>
            </div>

            <form method="GET" action="{{ route('admin.customers.index') }}" class="flex items-center gap-2">
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
                    <a href="{{ route('admin.customers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">
                        <i class="fa fa-times"></i> Réinitialiser
                    </a>
                @endif
            </form>
        </div>

        <x-table :columns="[
            'cardNumber' => 'Numéro de fiche',
            'lastName' => 'Nom',
            'firstName' => 'Prénom',
            'email' => 'Email',
            'city' => 'Ville',
            'portablePhone' => 'Téléphone',
            'type' => 'Type',
        ]" :data="$customers" :model="'customers'" />

        <div class="mt-4">
            {{ $customers->links() }}
        </div>
    </div>
</x-admin.layout>
