<x-admin.layout>
    <x-slot name="title">
        Importer une liste de véhicule
    </x-slot>

    <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('admin.vehicles.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <h2 class="text-2xl font-semibold text-gray-700">Importer un fichier Excel</h2>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-600">Sélectionner un fichier</label>
                <input type="file" name="file" id="file" required class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-2 text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    Importer
                </button>
            </div>
        </form>
    </div>
</x-admin.layout>
