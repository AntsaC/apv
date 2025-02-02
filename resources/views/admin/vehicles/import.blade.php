<x-admin.layout>
    <x-slot name="title">
        Importer une liste de véhicule
    </x-slot> 

    <div>
        <form action="{{ route('admin.vehicles.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required>
            <button type="submit">Import</button>
        </form>
    </div>
</x-admin.layout>
