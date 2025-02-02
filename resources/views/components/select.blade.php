@props(['disabled' => false, 'label'])

<div>
    @if ($label)
        <x-input-label>{{ $label }}</x-input-label>
    @endif
    <select {{ $attributes->merge(['class' => 'mt-1 block w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm'])}} >
        <option value="">Sélectionner...</option>
        {{ $slot }}
    </select>
</div>