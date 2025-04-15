<div class="flex flex-col col-span-5 gap-2 sm:flex-row sm:justify-end">
    <div class="flex flex-row-reverse justify-end gap-2 sm:justify-start sm:flex-row" x-show="$wire.selectedRecordIds.length > 0" x-cloak>
        <div class="flex items-center gap-1 text-sm text-gray-600">
            <span x-text="$wire.selectedRecordIds.length"></span>

            <span x-text="$wire.selectedRecordIds.length == 1 ? 'seleccionado' : 'seleccionados'"></span>
        </div>

        <div class="flex items-center px-3">
            <div class="h-[75%] w-[1px] bg-gray-300"></div>
        </div>

        @if (auth()->user()->can('Eliminar seguimiento FGSM'))
            <form wire:submit="deleteSelected"
                wire:confirm="¿Esta segura(o) que desea eliminar los registros seleccionados?"
            >
                <button type="submit"
                class="flex items-center gap-2 rounded-lg border border-red-600 px-3 py-1.5 bg-red-500 font-medium text-sm text-white hover:bg-red-600 disabled:cursor-not-allowed disabled:opacity-75"
                >
                    <x-icon.receipt-refund wire:loading.remove wire:target="deleteSelected" />

                    <x-icon.spinner wire:loading wire:target="deleteSelected" class="text-white" />

                    Eliminar
                </button>
            </form>
        @endif
    </div>
    @if (auth()->user()->can('Descargar seguimientos FGSM'))
    <div class="hidden sm:flex">
        <form wire:submit="export">
            <button type="submit" class="flex items-center gap-2 rounded-lg border px-3 py-1.5  font-medium text-sm text-white hover:bg-green-500 bg-green-600">
                <x-icon.arrow-down-tray wire:loading.remove wire:target="export" />

                <x-icon.spinner wire:loading wire:target="export" class="text-white" />

                Descargar
            </button>
        </form>
    </div>
    @endif
    <div class="hidden sm:flex">
        <select wire:model.change='perPage' class="flex items-center rounded-lg border py-1.5 bg-white font-medium text-sm">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="40">40</option>
            <option value="60">60</option>
        </select>
    </div>
</div>
