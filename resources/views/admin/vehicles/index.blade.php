<x-admin.layout>
    <x-slot name="title">
        Liste des vehicules
    </x-slot> 

    <div>
        <div class="d-flex">
            <x-button :href="route('admin.vehicles.create')" :type="'link'" >Nouveau</x-button>
            <x-button :href="route('admin.vehicles.import')" :type="'link'" >Importer</x-button>
        </div>
        <x-table :columns="[
            'vin' => 'VIN',
            'immatriculation' => 'Immatriculation',
            'brand' => 'Marque',
            'model' => 'Modèle',
            'kilometrage' => 'Kilometrage',
            'lastEventDate' => 'Dernier évènement',
            'customer.full_name'  => 'Client'
        ]" :data="$vehicles" :model="'vehicles'" />
    </div>
</x-admin.layout>
