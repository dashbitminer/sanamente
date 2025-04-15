@props(['departamentos', 'ciudades' => [], 'escuelas' => [], 'filters', 'escuelaSelected'])

<div class="grid grid-cols-1 gap-2 mt-4 sm:grid-cols-5">
    <div class="col-span-1 sm:col-span-1">
        <label for="filter1" class="block mb-2 text-sm font-medium text-gray-700">Departamento a la que Pertenece</label>
        <flux:select variant="listbox"
        clear="close" id="filter1" name="filter1"
        selected-suffix="seleccionados" wire:model.live='filters.departamentosSelected'
        multiple searchable placeholder="Seleccione opciones...">
            @foreach ($departamentos as $key => $value)
                <flux:option value="{{ $key }}">{{ $value }}</flux:option>
            @endforeach
        </flux:select>
    </div>
    <div class="col-span-1 sm:col-span-1">
        <label for="filter2" class="block mb-2 text-sm font-medium text-gray-700">Municipio a la que Pertenece</label>
        <flux:select variant="listbox" multiple searchable clear="close" selected-suffix="seleccionados"
        id="filter3" name="filter2"  wire:model.live='filters.municipiosSelected'
        placeholder="Seleccione opciones..." class="text-indigo-900 border-indigo-500 focus:ring-indigo-500">
            @foreach ($ciudades as $key => $value)
            <flux:option value="{{ $key }}">{{ $value }}</flux:option>
            @endforeach
        </flux:select>
    </div>
    <div class="col-span-1 sm:col-span-2">
        <label for="filter3" class="block mb-2 text-sm font-medium text-gray-700">Sede a la que Pertenece</label>
        <flux:select variant="listbox" multiple searchable clear="close" selected-suffix="seleccionados"
        id="filter3" name="filter3"  wire:model.live='filters.escuelasSelected'
        placeholder="Seleccione opciones..." class="text-indigo-900 border-indigo-500 focus:ring-indigo-500">
        @foreach ($escuelas as $key => $value)
            <flux:option value="{{ $key }}">{{ $value }}</flux:option>
        @endforeach
        </flux:select>
    </div>
    <div class="flex items-center col-span-1">
        <button type="button" wire:click="resetSearch"
            class="p-2 mt-6 text-gray-500 rounded hover:text-gray-700 hover:bg-gray-100">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
