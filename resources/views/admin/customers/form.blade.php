<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10">
        <h2 class="text-2xl font-semibold text-gray-800">Ajouter un Client</h2>

        <form action="{{ route('admin.customers.store') }}" method="POST" class="space-y-6 mt-6">
            @csrf

            <div>
                <label for="cardNumber" class="block text-sm font-medium text-gray-700">Numéro de fiche</label>
                <input type="text" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('cardNumber')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="civility" class="block text-sm font-medium text-gray-700">Civilité</label>
                <select id="civility" name="civility" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Sélectionner une civilité</option>
                    <option value="Mr" {{ old('civility') == 'Mr' ? 'selected' : '' }}>Monsieur</option>
                    <option value="Mme" {{ old('civility') == 'Mme' ? 'selected' : '' }}>Madame</option>
                    <option value="Ste" {{ old('civility') == 'Ste' ? 'selected' : '' }}>Société</option>
                    <option value="Gge" {{ old('civility') == 'Gge' ? 'selected' : '' }}>Garage</option>
                </select>
                @error('civility')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="firstName" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('firstName')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lastName" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('lastName')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('address')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="additionalAdress" class="block text-sm font-medium text-gray-700">Adresse complémentaire</label>
                <input type="text" id="additionalAdress" name="additionalAdress" value="{{ old('additionalAdress') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('additionalAdress')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                <input type="text" id="city" name="city" value="{{ old('city') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('city')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="homePhone" class="block text-sm font-medium text-gray-700">Téléphone fixe</label>
                <input type="text" id="homePhone" name="homePhone" value="{{ old('homePhone') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('homePhone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="portablePhone" class="block text-sm font-medium text-gray-700">Téléphone portable</label>
                <input type="text" id="portablePhone" name="portablePhone" value="{{ old('portablePhone') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('portablePhone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jobPhone" class="block text-sm font-medium text-gray-700">Téléphone pro</label>
                <input type="text" id="jobPhone" name="jobPhone" value="{{ old('jobPhone') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('jobPhone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select id="type" name="type" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="INDIVIDUAL" {{ old('type') == 'INDIVIDUAL' ? 'selected' : '' }}>Individu</option>
                    <option value="COMPANY" {{ old('type') == 'COMPANY' ? 'selected' : '' }}>Société</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="business_account_id" class="block text-sm font-medium text-gray-700">Compte entreprise</label>
                <select id="business_account_id" name="business_account_id" class="mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Aucun</option>
                    @foreach($accounts as $account)
                        <option value="{{ $account->id }}" {{ old('business_account_id') == $account->id ? 'selected' : '' }}>{{ $account->label }}</option>
                    @endforeach
                </select>
                @error('business_account_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Ajouter le Client
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
