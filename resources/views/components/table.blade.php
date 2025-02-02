@props(['columns' => [], 'data' => []])

<div class="mt-5 overflow-x-auto bg-white shadow-lg rounded-lg p-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                @foreach ($columns as $columnKey => $columnLabel)
                    <th scope="col"
                        class="px-6 py-3 text-left text-sm font-medium text-gray-600 cursor-pointer"
                        >
                        {{ $columnLabel }}
                    </th>
                @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($data as $row)
                    <tr>
                        @foreach ($columns as $columnKey => $columnLabel)
                            @php
                                // Vérifier si le champ est une relation (contient un point)
                                $value = $row;
                                foreach (explode('.', $columnKey) as $key) {
                                    $value = $value?->$key ?? null;
                                }
                            @endphp
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $value ?? '-' }}
                            </td>
                        @endforeach

                        <td>
                            <a href="{{ route('admin.customers.edit', $row->id) }}">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
