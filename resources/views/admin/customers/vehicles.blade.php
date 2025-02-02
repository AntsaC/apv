<x-admin.layout>
    <x-slot name="title">
        @if ($customer->id)
            <div class="flex">
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.customers.edit', $customer->id)" :active="request()->routeIs('admin.customers.edit', $customer->id)">
                            {{ __('Formulaire') }}
                        </x-nav-link>
                    </div>        

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.customers.vehicles', $customer->id)" :active="request()->routeIs('admin.customers.vehicles', $customer->id)">
                            {{ __('Vehicules du client') }}
                        </x-nav-link>
                    </div>
            </div>    
        @else
            Nouveau client
        @endif
    </x-slot>

    <div>
        <x-table :columns="[
            'vin' => 'VIN',
            'immatriculation' => 'Immatriculation',
            'brand' => 'Marque',
            'model' => 'Modèle',
            'kilometrage' => 'Kilometrage',
            'lastEventDate' => 'Dernier évènement',
            'eventOrigin' => 'Origine'
        ]" :data="$customer->vehicles" :model="'vehicles'" />
    </div>
</x-admin.layout>
