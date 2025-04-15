@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-dark-gray']) }}>
    {{ $value ?? $slot }}
</label>
