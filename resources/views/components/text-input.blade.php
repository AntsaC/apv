@props(['disabled' => false, 'label', 'name'])

<div>
    @isset($label)
        @if ($label)
            <x-input-label>{{ $label }}</x-input-label>
        @endif    
    @endisset
    <input @disabled($disabled) {{ $attributes->merge(['name' => $name, 'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 d-block w-full']) }}>
    @isset($name)
        @error($name)
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror    
    @endisset
    
</div>
