<div class="flex flex-col col-span-5 gap-2 sm:flex-row sm:justify-end">
    <div class="hidden sm:flex">
        <select wire:model.change='perPage' class="flex items-center rounded-lg border py-1.5 bg-white font-medium text-sm">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="40">40</option>
            <option value="60">60</option>
            <option value="100">100</option>
        </select>
    </div>
</div>
