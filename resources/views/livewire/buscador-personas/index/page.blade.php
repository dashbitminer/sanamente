<div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
        <div class="col-span-1">
            <label for="pais" class="block text-sm font-medium text-gray-700">Pais:</label>

            <flux:select variant="listbox" placeholder="Seleccione un pais" searchable clear="close" wire:model.live='filters.paisSelected'>
                @foreach ($paises as $pais)
                    <flux:option value="{{ $pais->codigo }}">
                        {{ $pais->nombre }}
                    </flux:option>
                @endforeach
            </flux:select>
        </div>
        <div class="col-span-1">
            <label for="departamento" class="block text-sm font-medium text-gray-700">Departamento:</label>

            <flux:select variant="listbox" placeholder="Seleccione un departamento" searchable clear="close" wire:model.live='filters.departamentoSelected'>
                @foreach ($departamentos as $departamento)
                    <flux:option value="{{ $departamento->fkCodeState }}">
                        {{ $departamento->name }}
                    </flux:option>
                @endforeach
            </flux:select>


            {{-- <select id="departamento" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  wire:model.live='filters.departamentoSelected'>
                <option value=""></option>
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento->fkCodeState }}">{{ $departamento->name }}</option>
                @endforeach
            </select> --}}
        </div>
        <div class="col-span-1">
            <label for="municipio" class="block text-sm font-medium text-gray-700">Municipio:</label>

            <flux:select variant="listbox" placeholder="Seleccione un municipio" searchable clear="close" wire:model.live='filters.municipioSelected'>
                @foreach ($municipios as $municipio)
                    <flux:option value="{{ $municipio->fkCodeMunicipality }}">
                        {{ $municipio->name }}
                    </flux:option>
                @endforeach
            </flux:select>

            {{-- <select id="municipio" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model.live='filters.municipioSelected'>
                <option value=""></option>
                @foreach ($municipios as $municipio)
                    <option value="{{ $municipio->fkCodeMunicipality }}">{{ $municipio->name }}</option>
                @endforeach
            </select> --}}
        </div>
        <div class="col-span-1">
            <label for="sede" class="block text-sm font-medium text-gray-700">Sede:</label>

            <flux:select variant="listbox" placeholder="Seleccione las opciones" searchable multiple clear="close" wire:model.live='filters.escuelaSelected'>
                @foreach ($escuelas as $escuela)
                    <flux:option value="{{ $escuela->school_id }}">
                        {{ $escuela->name }}
                    </flux:option>
                @endforeach
            </flux:select>


        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 mt-3 sm:grid-cols-4">
        <div class="col-span-1">
            <label for="perfil" class="block text-sm font-medium text-gray-700">Perfil:</label>

            <flux:select variant="listbox" placeholder="Seleccione un perfil" searchable  clear="close" wire:model.live='filters.tipoPersonaSelected'>
                @foreach ($tipoPersonas as $tipo)
                    <flux:option value="{{ $tipo->id }}">
                        {{ $tipo->name }}
                    </flux:option>
                @endforeach
            </flux:select>

            {{-- <select id="perfil" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model.live='filters.perfilSelected'>
                <option value=""></option>
                @foreach ($tipoPersonas as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                @endforeach
            </select> --}}
        </div>

        <div class="col-span-1" x-show="$wire.filters.tipoPersonaSelected == 10">
            <label for="perfil" class="block text-sm font-medium text-gray-700">Subtipo:</label>

            <flux:select variant="listbox" placeholder="Seleccione las opciones" searchable  multiple clear="close" wire:model.live='filters.subtipoSelected'>
                @foreach ($subtipos as $tipo)
                    <flux:option value="{{ $tipo->id }}">
                        {{ $tipo->name }}
                    </flux:option>
                @endforeach
            </flux:select>

            {{-- <select id="perfil" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model.live='filters.perfilSelected'>
                <option value=""></option>
                @foreach ($tipoPersonas as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->name }}</option>
                @endforeach
            </select> --}}
        </div>



        {{-- <div class="col-span-1">
            <label for="perfil" class="block text-sm font-medium text-gray-700">Perfil:</label>
            <select id="perfil" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model.live='filters.perfilSelected'>
                <option value=""></option>
                @foreach ($perfiles as $perfil)
                    <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="col-span-1">
            <label for="tipo_formacion" class="block text-sm font-medium text-gray-700">Tipo de Formación:</label>

            <flux:select variant="listbox" placeholder="Seleccione las opciones" searchable multiple clear="close" wire:model.live='filters.subcomponenteSelected'>
                @foreach ($subcomponentes as $sub)
                    <flux:option value="{{ $sub->id }}">
                        {{ $sub->name }}
                    </flux:option>
                @endforeach
            </flux:select>

            {{-- <select id="tipo_formacion" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value=""></option>
                @foreach ($subcomponentes as $sub)
                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select> --}}
        </div>
        <div class="col-span-1">
            <label for="grupo" class="block text-sm font-medium text-gray-700">Grupo:</label>

            <flux:select variant="listbox" placeholder="Seleccione las opciones" multiple searchable  clear="close" wire:model.live='filters.gruposSelected'>
                @foreach ($grupos as $grupo)
                    <flux:option value="{{ $grupo->id }}">
                        {{ $grupo->name }}
                    </flux:option>
                @endforeach
            </flux:select>

            {{-- <select id="grupo" class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <!-- Options here -->
            </select> --}}
        </div>
        <div class="col-span-1">
            <button wire:click='resetFilters' class="inline-flex items-center px-4 py-2 mt-6 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Limpiar filtros
            </button>
        </div>
    </div>


    <div class="mt-6">
        <livewire:buscador-personas.index.table :$filters />
    </div>
</div>
