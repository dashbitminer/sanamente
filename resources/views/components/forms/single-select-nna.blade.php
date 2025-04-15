@props(['disabled' => false, 'options' => [], 'selected' => null, 'name' => Str::random(10), 'selectedValue' => null])

<select
{{ $disabled ? 'disabled' : '' }}
{!! $attributes->merge(['class' => 'block w-full rounded-md  sm:leading-6 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
 >
    @if ($selected)
        <option value="" @selected( empty($selectedValue) ) >{{ $selected }}</option>
    @endif
    @foreach ($options as $key => $value)
        <option value="{{ $key }}" wire:key='{{ $name . '-'. $key }}' @selected(!empty($selectedValue) && $key == $selectedValue)>{{ $value }}</option>
    @endforeach
</select>
