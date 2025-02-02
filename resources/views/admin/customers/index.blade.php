<x-admin.layout>
    <x-slot name="title">
        Liste des clients
    </x-slot> 

    <div>
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
</x-admin.layout>
