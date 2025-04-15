<div x-data="formConsentimientoFields" class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6 " x-show="$wire.form.iniciar_proceso_referencia == 1">
    <div class="sm:col-span-3">
        <x-ref-input-label :class="!$form->esPublico ? 'sm:text-sm' : 'sm:text-lg'" for="form.modalid_consentimiento_id">{{ __('Modalidad de registro de consentimiento:') }}
            <x-required-label />
        </x-ref-input-label>
        <div class="mt-2">
            <x-forms.single-select name="form.modalid_consentimiento_id" wire:model='form.modalid_consentimiento_id' id="form.modalid_consentimiento_id"
                disabled="{{ $form->readonly ? 'disabled' : '' }}"
                x-ref="modalid_consentimiento_id"
                x-on:change="modalidadConsentimientoDropdown"
                x-init="modalidadConsentimientoDropdown({ target: $refs.modalid_consentimiento_id })"
                :options="$modalidad_consentimientos" selected="Seleccione una modalidad de registro de consentimiento" @class([ 'h-12 sm:text-lg',
                    'block w-full mt-1','border-2 border-red-500' => $errors->has('form.modalid_consentimiento_id'),
                    'sm:text-sm' => !$form->esPublico,
                    'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                ]) />
            <x-input-error :messages="$errors->get('form.modalid_consentimiento_id')" class="mt-2" aria-live="assertive" />
        </div>
    </div>

    @if($form->esMenorEdad)
        <div class="sm:col-span-3" >
            <x-ref-input-label class="{{ !$form->esPublico ? 'sm:text-sm' : 'sm:text-lg' }}">{{ __('Se cuenta con autorización de la persona adulta responsable') }}
                <x-required-label />
            </x-ref-input-label>
            <div class="pl-2 mt-2">
                <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                    <x-ref-input-label class="flex items-center h-12 gap-4 sm:text-lg" for="form.autorizacion_persona_adulta_1">
                        <x-forms.input-radio type="radio" wire:model="form.autorizacion_persona_adulta"
                            id="form.autorizacion_persona_adulta_1"
                            name="form.autorizacion_persona_adulta" type="radio" value="1" class="h-12 sm:text-lg" />Si
                    </x-ref-input-label>
                    <x-ref-input-label class="flex items-center h-12 gap-4 sm:text-lg" for="form.autorizacion_persona_adulta_0">
                        <x-forms.input-radio type="radio" wire:model="form.autorizacion_persona_adulta"
                            id="form.autorizacion_persona_adulta_0"
                            name="form.autorizacion_persona_adulta" type="radio" value="0" class="h-12 sm:text-lg" />No
                    </x-ref-input-label>
                </div>
                <x-input-error :messages="$errors->get('form.autorizacion_persona_adulta')" class="mt-2" />
            </div>
        </div>
    @endif


    <div class="sm:col-span-3" x-show="modalidad_consentimiento_fisico || $wire.form.autorizacion_persona_adulta == 1">
        @if(!$form->readonly)
        <div x-data="{ uploading: false, progress: 0 }"
            x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false"
            x-on:livewire-upload-cancel="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

            <x-ref-input-label for="documento_consentimientos"
                class="block mb-2 sm:text-lg">{{ __('Adjuntar consentimiento:') }}
                <x-required-label />
            </x-ref-input-label>

            <!-- File Input -->
            <input type="file" wire:model.live="form.documento_consentimientos"
            @class([
                "w-full text-sm font-semibold text-dark-gray bg-white border rounded
                cursor-pointer file:cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4
                file:bg-gray-100 file:hover:bg-gray-200 file:text-dark-gray",
                'sm:text-sm' => !$form->esPublico,
                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
            ])
            />
            <p class="mt-2 text-xs text-dark-gray">Tipos de archivos permitidos: PNG, JPG,
                GIF, DOCX y PDF.</p>

            <!-- Progress Bar -->
            <div x-show="uploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>

            <x-input-error :messages="$errors->get('form.documento_consentimientos')"
                class="mt-2" aria-live="assertive" />
        </div>
        @endif
    </div>



    @if (!$form->readonly)
        <div class="sm:col-span-full sm:text-lg">
            <p>Por este medio yo {{ $nombreCompleto }} , de {{ $form->edad }} años de edad, he sido informado(a) que mis datos serán utilizados para usos exclusivos
            del programa a favor de mi referencia y serán manejados unicamente por el equipo de Glasswing International y sus socios.
            Además, por este medio (acepto) de forma voluntaria que se me refiera al servicio solicitado anteriormente, sabiendo que no necesariamente
            será Glasswing la entidad responsable de mis servicios. </p>

            <p class="mt-5">La persona acepta de forma verbal la referencia <input type="checkbox" wire:model="form.acepta_referencia" class="ml-5" ></p>

            <x-input-error :messages="$errors->get('form.acepta_referencia')"
                class="mt-2" aria-live="assertive" />

            <div class="mt-[25px] flex text-center">
                <div class="flex flex-col items-center justify-center w-1/2">
                    <div class="signature-1">
                        <x-signature-pad wire:model="form.signature_persona"></x-signature-pad>
                    </div>
                    @if (!$form->esMenorEdad)
                        <span>Firma o huella de la persona referida</span>
                    @else
                        <span>Firma o huella de la persona adulta responsable</span>
                    @endif
                </div>
                <div class="items-center w-1/2">Nombre o huella de la persona que refiere</div>
            </div>
        </div>
    @endif

    @if ($form->esMenorEdad && !$form->readonly)
    <div class="sm:col-span-full sm:text-lg">
        <div class="pb-12 mb-10 border-b border-emerald-900/10"></div>

        <p >Por este medio declaro que la NNA ha sido escuchada y su opinión ha sido considerada para otorgar las
            autorizaciones de este documento, de acuerdo con su edad y madurez. En señal de conformidad la NNA firma o coloca su huella en este documento. </p>

        <p class="mt-5">La persona acepta de forma verbal la referencia <input type="checkbox" wire:model="form.autoriza_adulto" class="ml-5" ></p>

        <x-input-error :messages="$errors->get('form.autoriza_adulto')"
            class="mt-2" aria-live="assertive" />

        <div class="mt-[25px] flex text-center">
            <div class="flex flex-col items-center justify-center w-1/2">
                <div class="signature-2">
                    <x-signature-pad wire:model="form.signature_autoriza_adulto"></x-signature-pad>
                </div>
                <span>Firma o huella de la persona adulta responsable</span>
            </div>
            <div class="items-center w-1/2">Nombre o huella de la persona que refiere</div>
        </div>
    </div>
    @endif
</div>

@script
<script>
    Alpine.data('formConsentimientoFields', () => ({
        modalidad_consentimiento_fisico: false,
        modalidadConsentimientoDropdown(event){
            const selectedOption = event.target.options[event.target.selectedIndex];
            this.modalidad_consentimiento_fisico = selectedOption.text.includes("Registro de consentimiento físico");
        }
    }))
</script>
@endscript
