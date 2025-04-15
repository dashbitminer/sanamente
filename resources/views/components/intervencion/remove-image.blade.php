@props(['click'])
<a class="flex justify-center cursor-pointer" wire:click="{{ $click }}">
    <svg class="mt-3" width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M7 12L17 12" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="12" cy="12" r="9" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
