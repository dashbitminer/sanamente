<div x-data="signaturePad()"
    x-init="initPad(); $watch('value', () => $wire.set('{{ $attributes->wire('model')->value() }}', value)); listenForClear('{{ $attributes->wire('model')->value() }}')">
    <div class="w-full flex items-center">
        <canvas x-ref="signature_canvas" width="350px" height="200px" class="border rounded shadow bg-white"></canvas>
    </div>
    <div class="flex justify-center">
        <button @click="clear"
            type="button" 
            class="px-4 py-2 mt-4 font-bold text-white bg-red-500 rounded hover:bg-red-700">
            Limpiar Firma
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('alpine:init', () => {
            Alpine.data('signaturePad', () => ({
                signaturePadInstance: null,
                value: '',
                initPad() {
                    this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas);
                    this.signaturePadInstance.onEnd = () => {
                        this.value = this.signaturePadInstance.toDataURL('image/png');
                    };
                },
                clear() {
                    this.signaturePadInstance.clear();
                    this.value = '';
                },
                listenForClear(eventName) {
                    document.addEventListener(`clear-signature:${eventName}`, () => {
                        this.clear();
                    });
                },
            }));
        });
    });
</script>
