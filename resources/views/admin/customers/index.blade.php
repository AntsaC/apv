<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container m-auto">
            <div class="d-flex">
                <x-button :href="route('admin.customers.create')" :type="'link'" >Nouveau</x-button>
            </div>
            <x-table :columns="[
                'cardNumber' => 'Numéro de fiche',
                'lastName' => 'Nom',
                'firstName' => 'Prénom',
                'email' => 'Email',
                'type' => 'Type',
                'businessAccount.label' => 'Compte entreprise',
                'eventAccount.label' => 'Compte événement',
                'lastEventAccount.label' => 'Dernier compte événement',
            ]" :data="$customers" :model="'customers'" />
        </div>
    </div>
</x-app-layout>
