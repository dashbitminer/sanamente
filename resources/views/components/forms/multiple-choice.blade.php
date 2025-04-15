@props(['options' => [], 'placeholderValue' => 'Seleccione una opción', 'model', 'init'=> '', 'selected' => []])

@php
    $uniqId = 'select' . uniqid();
@endphp

<div wire:ignore
     x-data="{
        initializeChoices() {
            const choices = new Choices($refs.{{ $uniqId }}, {
                removeItems: true,
                removeItemButton: true,
                placeholderValue: '{{ $placeholderValue }}',
                shouldSort: false
            });

            if ('{{ $init }}' && typeof window['{{ $init }}'] === 'function') {
                window['{{ $init }}']({ target: $refs.{{ $uniqId }} });
            }

            document.addEventListener('deselect-all-{{ $model }}', () => {
                choices.clearStore();
                $dispatch('input', []);
            });

            $el.addEventListener('destroy', () => {
                choices.destroy();
            });
        }
     }"
     x-init="initializeChoices"
>
    <select
        x-ref="{{ $uniqId }}"
        wire:change="$set('{{ $model }}', [...$event.target.selectedOptions].map(option => option.value))"
        {{ $attributes }}
        multiple
        x-init="{{ $init }}({ target: $refs.{{ $uniqId }} })"
        @class([
            'block w-full mt-1 h-12 sm:text-lg',
            'border-2 border-red-500' => $errors->has($model),
        ])
    >
        @foreach($options as $key => $option)
            @if (in_array($key, $selected))
                <option value="{{ $key }}" selected>{{ $option }}</option>
            @else
                <option value="{{ $key }}">{{ $option }}</option>
            @endif
        @endforeach
    </select>
</div>
