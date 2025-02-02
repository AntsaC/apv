<x-admin.layout>
    <x-slot name="title">
        {{ $vehicle->id ? 'Modifier le véhicule' : 'Ajouter un Véhicule'}}
    </x-slot>

    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <form action="{{ $vehicle->id ? route('admin.vehicles.update', $vehicle->id) : route('admin.vehicles.store') }}" method="POST" class="space-y-6">
            @if ($vehicle->id)
                @method('PUT')
            @endif
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-text-input :name="'immatriculation'" label="Immatriculation" :value="old('immatriculation', $vehicle->immatriculation)" />
                <x-text-input :name="'vin'" label="VIN" :value="old('vin', $vehicle->vin)" />
                <x-text-input :name="'brand'" label="Marque" :value="old('brand', $vehicle->brand)" />
                <x-text-input :name="'model'" label="Modèle" :value="old('model', $vehicle->model)" />
                <x-text-input :name="'version'" label="Version" :value="old('version', $vehicle->version)" />
                <x-text-input :name="'kilometrage'" type="number" label="Kilométrage" :value="old('kilometrage', $vehicle->kilometrage)" />
                <x-text-input :name="'circulationDate'" type="date" label="Date de circulation" :value="old('circulationDate', $vehicle->circulationDate)" />
                <x-text-input :name="'purchaseDate'" type="date" label="Date d'achat" :value="old('purchaseDate', $vehicle->purchaseDate)" />
                <x-text-input :name="'eventDate'" type="date" label="Date d'évènement" :value="old('eventDate', $vehicle->eventDate)" />
                <x-text-input :name="'lastEventDate'" type="date" label="Dernier évènement" :value="old('lastEventDate', $vehicle->lastEventDate)" />

                <x-select name="energy" label="Énergie">
                    @foreach ( $energies as $energy)
                        <option value="{{ $energy }}" {{ old('energy', $vehicle->energy) == $energy->value ? 'selected' : '' }}>{{ $energy }}</option>
                    @endforeach
                </x-select>
                <x-select name="saleType" label="Type de vente">
                        <option value="VO" {{ old('saleType', $vehicle->saleType) == 'VO' ? 'selected' : '' }}>VO</option>
                        <option value="VN" {{ old('saleType', $vehicle->saleType) == 'VN' ? 'selected' : '' }}>VN</option>
                </x-select>
                <x-text-input :name="'saleFileNumber'" label="Numéro de dossier" :value="old('saleFileNumber', $vehicle->saleFileNumber)" />
                <x-select name="eventOrigin" label="Origine">
                    @foreach ( $origins as $origin)
                        <option value="{{ $origin }}" {{ old('eventOrigin', $vehicle->eventOrigin) == $origin->value ? 'selected' : '' }}>{{ $origin->label() }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-select name="vn_seller_id" label="Vendeur VN">
                    @foreach ( $sellers as $seller)
                        <option value="{{ $seller->id }}" {{ old('vn_seller_id', $vehicle->vnSeller ? $vehicle->vnSeller->id : '') == $seller->id ? 'selected' : '' }}>{{ $seller->name }}</option>
                    @endforeach
                </x-select>

                <x-select name="vo_seller_id" label="Vendeur VO">
                    @foreach ( $sellers as $seller)
                        <option value="{{ $seller->id }}" {{ old('vo_seller_id', $vehicle->voSeller ? $vehicle->voSeller->id : '') == $seller->id ? 'selected' : '' }}>{{ $seller->name }}</option>
                    @endforeach
                </x-select>

                <x-select name="intermediate_seller_id" label="Vendeur Intermédiaire">
                    @foreach ( $sellers as $seller)
                        <option value="{{ $seller->id }}" {{ old('intermediate_seller_id', $vehicle->intermediateSeller ? $vehicle->intermediateSeller->id : '') == $seller->id ? 'selected' : '' }}>{{ $seller->name }}</option>
                    @endforeach
                </x-select>
            </div>



            <div class="pt-6">
                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                    {{ $vehicle->id ? 'Modifier le véhicule' : 'Ajouter le Véhicule' }}
                </button>
            </div>
        </form>
    </div>
</x-admin.layout>