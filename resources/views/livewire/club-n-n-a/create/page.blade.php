<div class="px-4 sm:px-0 text-club-nna">
    <div class="flex flex-col items-center justify-between sm:flex-row">
        <div class="flex w-full justify-center">
            <img src="{{ asset('images/Glasswing-logo.png') }}" alt="Glasswing" class="w-2/5 sm:w-4/5 max-w-96">
        </div>
    </div>

    <h1 class="mt-10 mb-1 text-4xl font-bold text-center">Club de Niñas</h1>
    <h2 class="mb-10 text-3xl font-bold text-center">Ficha de inscripción {{ date('Y') }}</h2>
    

    <p class="mt-4 text-lg leading-7 text-justify text-club-nna">
        {{ $labels['bienvenido'] }}
    </p>

    @auth
        <div class="mt-10">
            <a href="{{ route('club-nna.index', ['pais' => $pais]) }}"
                class="block w-full px-8 py-3 font-medium text-white rounded-lg bg-club-nna-bg-2 text-uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline-block w-5 h-5 mr-2 size-5">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                </svg>
                Volver al visualizador
            </a>
        </div>
    @endauth
    
    <form wire:submit='save' class="md:col-span-2">
        <div class="space-y-12 pb-12 border-b border-gray-900/10">
            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-full">
                    <h2 class="text-2xl font-bold text-center">Campo a llenar por adulto responsable.</h2>
                </div>

                <div class="col-span-full">
                    <label class="block text-club-nna sm:text-lg mb-5 text-justify">
                        <strong>1. AUTORIZACIÓN DE PARTICIPACIÓN: Es necesaria la expresa autorización por usted para respaldar la participación de la NNA en nuestros programas.</strong> Para su conocimiento, Glasswing desarrolla mecanismos de supervisión en sus actividades y, tanto el staff como voluntarios(as), deben cumplir con un Código de Conducta y lineamientos de Salvaguarda y Protección Infantil. También debe de saber que <strong>estas actividades pueden desarrollarse de manera presencial o virtual, y que la persona adulta responsable debe brindar supervisión adecuada para la NNA a cargo, en las actividades que lo ameriten.</strong>
                        <x-required-label />
                    </label>
                    <div class="px-4 py-3">
                        <div class="flex flex-col gap-4">
                            <x-input-label class="flex items-center gap-4 sm:text-lg text-club-nna" for="form.autorizacion_participacion_1">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_participacion"
                                    id="form.autorizacion_participacion_1"
                                    name="form.autorizacion_participacion" type="radio" value="1" /><span class="text-club-nna">Autorizo Participación</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg text-club-nna" for="form.autorizacion_participacion_0">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_participacion"
                                    id="form.autorizacion_participacion_0"
                                    name="form.autorizacion_participacion" type="radio" value="0" /><span class="text-club-nna">No autorizo Participación</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.autorizacion_participacion')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="col-span-full text-justify" x-cloak x-show="$wire.form.autorizacion_participacion == 1">
                    <label class="block text-club-nna sm:text-lg mb-5 ">
                        <strong>2. AUTORIZACIÓN PARA USAR DATOS PERSONALES EN FORMULARIO DE INSCRIPCIÓN: Es necesaria la expresa autorización por usted para respaldar que la presente información de inscripción de la NNA, ha sido brindada de forma voluntaria</strong>, la información será utilizada exclusivamente por Glasswing y se almacenará de forma segura; asimismo, le informamos que podemos generar datos separados por grupos, asegurándonos de que sean anónimos para que no se pueda identificar a ninguna persona. Estos datos se utilizarán para campañas publicitarias, promoción de donaciones a favor del trabajo de Glasswing  y elaboración de reportes generales.
                        <x-required-label />
                    </label>
                    <div class="px-4 py-3">
                        <div class="flex flex-col gap-4">
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_datos_personales_1">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_datos_personales"
                                    id="form.autorizacion_datos_personales_1"
                                    name="form.autorizacion_datos_personales" type="radio" value="1" /><span class="text-club-nna">Autorizo la recolección y uso de información</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_datos_personales_0">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_datos_personales"
                                    id="form.autorizacion_datos_personales_0"
                                    name="form.autorizacion_datos_personales" type="radio" value="0" /><span class="text-club-nna">No autorizo la recolección y uso de información</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.autorizacion_datos_personales')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="col-span-full text-justify" x-cloak x-show="$wire.form.autorizacion_datos_personales == 1">
                    <label class="block text-club-nna sm:text-lg mb-5">
                        <strong>3. AUTORIZACIÓN DE USO DE VOZ E IMAGEN: {{ $labels['autorizacion'] }}</strong>
                        <x-required-label />
                        <ul class="mt-2 list-disc sm:text-lg space-y-3 space-x-7">
                            <li>Uso exclusivo en plataformas institucionales y para la rendición de cuentas a los socios de Glasswing, que podrán compartir y publicar esta información a través de sus propios canales (cooperación internacional, empresas, organizaciones o centros educativos).</li>
                            <li>El uso de fotografías o videos en formas de comunicación y medios según corresponda al trabajo de Glasswing.</li>
                            <li>Uso de voz e imagen para eventos o presentaciones públicas, exclusivamente para la promoción y marketing de Glasswing.</li>
                            <li>Ninguna fotografía o video se podrá utilizar para fines políticos, religiosos o personales por ninguna persona de la 
                                Fundación, o externos a ella.</li>
                            <li><strong>La autorización para el uso de voz e imagen no es un requisito para participar en nuestras iniciativas o programas.</strong></li>
                            <li>Brindar el derecho de usar, publicar, reproducir y compartir el primer nombre o con el que desee ser identificada la NNA, foto o semejanza en video, su voz grabada, citas y comentarios en todos los medios para promover actividades de comunicaciones, recaudación de fondos, marketing y otros sin fines de lucro relacionados con Glasswing (en adelante los "materiales").</li>
                            <li>Autorizar la edición de dichos materiales y aceptar que Glasswing no estará obligado a entregar materiales, ya sea en versión física o digital, de cualquier titular que lo exija o solicite.</li>
                        </ul>
                    </label>
                    <div class="px-4 py-3">
                        <div class="flex flex-col gap-4">
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_voz_image_1">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_voz_image"
                                    id="form.autorizacion_voz_image_1"
                                    name="form.autorizacion_voz_image" type="radio" value="1"  /><span class="text-club-nna">Autorizo el uso de voz e imagen</span>
                            </x-ref-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_voz_image_0">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_voz_image"
                                    id="form.autorizacion_voz_image_0"
                                    name="form.autorizacion_voz_image" type="radio" value="0" /><span class="text-club-nna">No autorizo el uso de voz e imagen</span>
                            </x-ref-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.autorizacion_voz_image')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="col-span-full text-justify" x-cloak  x-show="$wire.form.autorizacion_datos_personales == 1" >
                    <label class="block text-club-nna sm:text-lg mb-5">
                        <strong>4. CONSENTIMIENTO PARA PARTICIPAR EN ENCUESTA DE EVALUACIÓN DEL PROGRAMA:</strong> Glasswing realiza encuestas para entender cómo el programa impacta a sus participantes y así mejorar los servicios, esta encuesta se realizará al finalizar el club. Queremos pedir su permiso para que su NNA participe. La participación en la encuesta es voluntaria y en ningún momento se revelará la identidad de la niña, niño o adolescente. Sus respuestas serán anónimas y únicamente nos ayudarán a encontrar nuevas formas en la que podemos mejorar nuestro trabajo. Si decide no autorizar, esto no afectará de ninguna manera la participación en las actividades de Glasswing.
                        <x-required-label />
                    </label>
                    <div class="px-4 py-3">
                        <div class="flex flex-col gap-4">
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_consentimiento_1">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_consentimiento"
                                    id="form.autorizacion_consentimiento_1"
                                    name="form.autorizacion_consentimiento" type="radio" value="1" /><span class="text-club-nna">Autorizo participación en encuesta</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_consentimiento_0">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_consentimiento"
                                    id="form.autorizacion_consentimiento_0"
                                    name="form.autorizacion_consentimiento" type="radio" value="0" /><span class="text-club-nna">No autorizo participación en encuesta</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.autorizacion_consentimiento')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" 
                x-cloak
                x-show="$wire.form.autorizacion_participacion == 1
                && $wire.form.autorizacion_datos_personales == 1
                ">  
                <div class="col-span-full">
                    <p class="mt-4 text-lg leading-7 text-justify text-club-nna">
                        Es importante que sepa que tiene el derecho a acceder, rectificar, cancelar y retirar su autorización de participación, compartir datos personales y uso de voz e imagen, en cualquier momento. Para tal efecto, puede enviar un correo a <strong>{{ $labels['email'] }}</strong>, notificando el retiro de su autorización para una o todas las autorizaciones brindadas en los apartados anteriores. 
                    </p>
                </div>
                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.nombres_responsable"><span class="text-club-nna">{{ __('Nombres y Apellidos completos del adulto responsable:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-text-input wire:model.live="form.nombres_responsable" id="form.nombres_responsable" name="form.nombres_responsable"
                            type="text" placeholder="Nombres y Apellidos"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres_responsable'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ])
                            />
                        <x-input-error :messages="$errors->get('form.nombres_responsable')" class="mt-2" />
                    </div>
                </div>
            
                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.parentesco"><span class="text-club-nna">{{ __('Parentesto con la NNA o forma en la que acredita la representación legal de la NNA:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.parentesco" wire:model='form.parentesco' id="form.parentesco"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$parentescos"
                             selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.parentesco'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.parentesco')" class="mt-2" aria-live="assertive" />
                    </div>
                </div> 

                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.telefono"><span class="text-club-nna">{{ __('Número de teléfono (incluya el que usa para WhatsApp):') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-text-input wire:model.live="form.telefono" id="form.telefono" name="form.telefono"
                            type="tel"
                            placeholder="55555555" maxlength="{{ $form->telephone_length }}"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            
                            @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.telefono'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ])
                            />
                        <x-input-error :messages="$errors->get('form.telefono')" class="mt-2" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.documento_identidad"><span class="text-club-nna">{{ $labels['dni_label'] }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-text-input wire:model="form.documento_identidad" id="form.documento_identidad" name="form.documento_identidad"
                            type="text"
                            placeholder="{{ $form->duiplaceholder }}" 
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            x-mask="{{ $form->dniformat }}" 
                            maxlength="{{ $form->dui_maxlength }}" 
                            @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.documento_identidad'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ])
                            />
                        <x-input-error :messages="$errors->get('form.documento_identidad')" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-full text-justify">
                    <p class="mt-4 text-lg leading-7 text-justify text-club-nna">
                        Con el objetivo de asegurar que la información sea entregada adecuadamente por nuestra institución, le pedimos que nos apoye completando lo siguiente:
                    </p>
                </div>

                <div class="col-span-full text-justify">
                    <table>
                        <tr class="border-b border-gray-900/10">
                            <td class="w-4/5 pe-4">
                                <x-input-label class="sm:text-lg mb-3 mt-3" for="form.confirmo_copia_documento">
                                    <span class="text-club-nna">{{ __('Confirmo que he recibido una copia de este documento, ya sea en formato físico o digital.') }}</span>
                                    <x-required-label />
                                </x-input-label>
                            </td>
                            <td class="ps-4 align-middle">
                                <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row w-full justify-center">
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.confirmo_copia_documento_1">
                                        <x-forms.input-radio type="radio" wire:model="form.confirmo_copia_documento"
                                            id="form.confirmo_copia_documento_1"
                                            name="form.confirmo_copia_documento" type="radio" value="1" /><span class="text-club-nna">Sí</span>
                                    </x-input-label>
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.confirmo_copia_documento_0">
                                        <x-forms.input-radio type="radio" wire:model="form.confirmo_copia_documento"
                                            id="form.confirmo_copia_documento_0"
                                            name="form.confirmo_copia_documento" type="radio" value="0" /><span class="text-club-nna">No</span>
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.confirmo_copia_documento')" class="mt-2" aria-live="assertive" />
                            </td>
                        </tr>
                        <tr class="border-b border-gray-900/10">
                            <td class="w-4/5 pe-4">
                                <x-input-label class="sm:text-lg mb-3 mt-3" for="form.informado_sobre_nna">
                                    <span class="text-club-nna">{{ __('Me han informado sobre el propósito y las actividades en las que participará la NNA.') }}</span>
                                    <x-required-label />
                                </x-input-label>
                            </td>
                            <td class="ps-4 align-middle">
                                <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row w-full justify-center">
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.informado_sobre_nna_1">
                                        <x-forms.input-radio type="radio" wire:model="form.informado_sobre_nna"
                                            id="form.informado_sobre_nna_1"
                                            name="form.informado_sobre_nna" type="radio" value="1" /><span class="text-club-nna">Sí</span>
                                    </x-input-label>
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.informado_sobre_nna_0">
                                        <x-forms.input-radio type="radio" wire:model="form.informado_sobre_nna"
                                            id="form.informado_sobre_nna_0"
                                            name="form.informado_sobre_nna" type="radio" value="0" /><span class="text-club-nna">No</span>
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.informado_sobre_nna')" class="mt-2" aria-live="assertive" />
                            </td>
                        </tr>
                        <tr class="border-b border-gray-900/10">
                            <td class="w-4/5 pe-4">
                                <x-input-label class="sm:text-lg mb-3 mt-3" for="form.nna_ha_escuchado">
                                    <span class="text-club-nna">{{ __('Declaro que la NNA ha sido escuchada y su opinión ha sido considerada para otorgar las autorizaciones de este documento, de acuerdo con su edad y madurez. En señal de conformidad la NNA firma o coloca su huella en este documento.') }}</span>
                                    <x-required-label />
                                </x-input-label>
                            </td>
                            <td class="ps-4 align-middle">
                                <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row w-full justify-center">
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.nna_ha_escuchado_1">
                                        <x-forms.input-radio type="radio" wire:model="form.nna_ha_escuchado"
                                            id="form.nna_ha_escuchado_1"
                                            name="form.nna_ha_escuchado" type="radio" value="1" /><span class="text-club-nna">Sí</span>
                                    </x-input-label>
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.nna_ha_escuchado_0">
                                        <x-forms.input-radio type="radio" wire:model="form.nna_ha_escuchado"
                                            id="form.nna_ha_escuchado_0"
                                            name="form.nna_ha_escuchado" type="radio" value="0" /><span class="text-club-nna">No</span>
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.nna_ha_escuchado')" class="mt-2" aria-live="assertive" />
                            </td>
                        </tr>
                        <tr>
                            <td class="w-4/5 pe-4">
                                <x-input-label class="sm:text-lg mt-3" for="form.leido_comprendido">
                                    <span class="text-club-nna">{{ __('Manifiesto que he leído y comprendido en su totalidad el documento y otorgo consentimiento para que los datos de la NNA sean tratados conforme a dicha información.') }}</span>
                                    <x-required-label />
                                </x-input-label>
                            </td>
                            <td class="ps-4 align-middle">
                                <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row w-full justify-center">
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.leido_comprendido_1">
                                        <x-forms.input-radio type="radio" wire:model="form.leido_comprendido"
                                            id="form.leido_comprendido_1"
                                            name="form.leido_comprendido" type="radio" value="1" /><span class="text-club-nna">Sí</span>
                                    </x-input-label>
                                    <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.leido_comprendido_0">
                                        <x-forms.input-radio type="radio" wire:model="form.leido_comprendido"
                                            id="form.leido_comprendido_0"
                                            name="form.leido_comprendido" type="radio" value="0" /><span class="text-club-nna">No</span>
                                    </x-input-label>
                                </div>
                                <x-input-error :messages="$errors->get('form.leido_comprendido')" class="mt-2" aria-live="assertive" />
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="sm:col-span-full text-justify">
                    <p class="mt-4 text-lg leading-7 text-justify text-club-nna">
                        Hago constar que conozco toda la información necesaria para autorizar la participación del  NNA a mi cargo (autorización de participación, autorización para compartir datos, autorización de uso de voz e imagen y autorización de participar en encuesta) y que los campos de autorización e información han sido completados por mi persona. 
                    </p>
                </div>
                <div class="col-span-full" >
                    <label class="block text-club-nna sm:text-lg">
                        Se dará firma de autorización:
                        <x-required-label />
                    </label>
                    <div class="px-4 py-3">
                        <div class="flex flex-col gap-4">
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.firmaDigitalRepresentante_1">
                                <x-forms.input-radio type="radio" wire:model="form.firmaDigitalRepresentante"
                                    id="form.firmaDigitalRepresentante_1"
                                    name="form.firmaDigitalRepresentante" type="radio" value="1"  /><span class="text-club-nna">Digital</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.firmaDigitalRepresentante_0">
                                <x-forms.input-radio type="radio" wire:model="form.firmaDigitalRepresentante"
                                    id="form.firmaDigitalRepresentante_0"
                                    name="form.firmaDigitalRepresentante" type="radio" value="0" /><span class="text-club-nna">Física</span>
                            </x-input-label>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-full flex flex-col items-center" x-cloak x-show="$wire.form.firmaDigitalRepresentante == 1"> 
                    <div x-data="signaturePad" x-init="init">
                        <div class="flex justify-center mt-8">
                            <canvas x-ref="signaturePad" class="border border-gray-300 rounded-lg bg-white" width="400"
                                height="200"></canvas>
                        </div>
                        <div class="flex justify-center">
                            <button type="button" @click="clearCanvas"
                                class="px-4 py-2 mt-4 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                Limpiar Firma
                            </button>
                        </div>
                    </div>
                    <p class="mt-4 text-lg leading-7 text-justify text-club-nna">
                        Firma del representante legal del menor de edad 
                    </p>
                    <x-input-error :messages="$errors->get('form.signature_responsable')" class="mt-2" aria-live="assertive" />
                </div>
                
            </div>

            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6" 
                x-cloak
                x-show="$wire.form.informado_sobre_nna == 1
                && $wire.form.nna_ha_escuchado == 1
                && $wire.form.leido_comprendido == 1"
                > 
                <div class="sm:col-span-full">
                    <h2 class="mb-2 text-2xl font-bold text-center">Campo a llenar por la niña, niño o adolescente</h2>
                </div>

                <div class="sm:col-span-full text-justify">
                    <label class="block text-club-nna sm:text-lg">
                        <strong>1. AUTORIZACIÓN DE PARTICIPACIÓN:</strong> Queremos confirmar tu interés en participar en los programas y actividades de Glasswing. Nos aseguramos de que todas las personas involucradas cumplan con un código de conducta para proteger a  niñas, niños y adolescentes. Las actividades pueden ser en persona o en línea, y debe haber un adulto supervisándote cuando sea necesario. Además, nos interesa que tus datos, voz o imagen sean utilizados solo si nos brindas tu permiso para hacerlo, si solo deseas participar; sin que usemos tu información, esto no afectará tu inscripción en el programa. A continuación se presentan casillas , en las cuales tu tutelar o referente Glasswing te explicarán en qué consiste la autorización. 
                        <x-required-label />
                    </label>
                    <div class="px-4 py-3 border-b border-gray-900/10 mb-2">
                        <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                            <x-input-label class="flex items-center gap-4 h-12 sm:text-lg basis-1/2" for="form.deseo_participar_1">
                                <x-forms.input-radio type="radio" wire:model="form.deseo_participar"
                                    id="form.deseo_participar_1"
                                    name="form.deseo_participar" type="radio" value="1" /><span class="text-club-nna">Sí deseo participar</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 h-12 sm:text-lg basis-1/2" for="form.deseo_participar_0">
                                <x-forms.input-radio type="radio" wire:model="form.deseo_participar"
                                    id="form.deseo_participar_0"
                                    name="form.deseo_participar" type="radio" value="0" /><span class="text-club-nna">No deseo participar</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.deseo_participar')" class="mt-2" aria-live="assertive" />
                    </div>

                    <div class="px-4 py-3 border-b border-gray-900/10 mb-2">
                        <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                            <x-input-label class="flex items-center gap-4 sm:text-lg basis-1/2" for="form.uso_recoleccion_datos_1">
                                <x-forms.input-radio type="radio" wire:model="form.uso_recoleccion_datos"
                                    id="form.uso_recoleccion_datos_1"
                                    name="form.uso_recoleccion_datos" type="radio" value="1" /><span class="text-club-nna">Autorizo la recolección y uso de mi información</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg basis-1/2" for="form.uso_recoleccion_datos_0">
                                <x-forms.input-radio type="radio" wire:model="form.uso_recoleccion_datos"
                                    id="form.uso_recoleccion_datos_0"
                                    name="form.uso_recoleccion_datos" type="radio" value="0" /><span class="text-club-nna">No autorizo la recolección y uso de mi información</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.uso_imagen')" class="mt-2" aria-live="assertive" />
                    </div>
                    <div class="px-4 py-3 border-b border-gray-900/10 mb-2">
                        <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                            <x-input-label class="flex items-center gap-4 sm:text-lg basis-1/2" for="form.uso_imagen_1">
                                <x-forms.input-radio type="radio" wire:model="form.uso_imagen"
                                    id="form.uso_imagen_1"
                                    name="form.uso_imagen" type="radio" value="1" /><span class="text-club-nna">Autorizo el uso de voz e imagen</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg basis-1/2" for="form.uso_imagen_0">
                                <x-forms.input-radio type="radio" wire:model="form.uso_imagen"
                                    id="form.uso_imagen_0"
                                    name="form.uso_imagen" type="radio" value="0"  /><span class="text-club-nna">No autorizo el uso de voz e imagen</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.uso_imagen')" class="mt-2" aria-live="assertive" />
                    </div>

                    <div class="px-4 py-3">
                        <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                            <x-input-label class="flex items-center gap-4 sm:text-lg basis-1/2" for="form.autorizo_participacion_1">
                                <x-forms.input-radio type="radio" wire:model="form.autorizo_participacion"
                                    id="form.autorizo_participacion_1"
                                    name="form.autorizo_participacion" type="radio" value="1" /><span class="text-club-nna">Autorizo mi participación en la encuesta</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg basis-1/2" for="form.autorizo_participacion_0">
                                <x-forms.input-radio type="radio" wire:model="form.autorizo_participacion"
                                    id="form.autorizo_participacion_0"
                                    name="form.autorizo_participacion" type="radio" value="0" /><span class="text-club-nna">No Autorizo mi participación en la encuesta</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.autorizo_participacion')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-full">
                    <x-input-label class="sm:text-lg" for="form.autorizacion_nna">
                        <span class="text-club-nna">{{ __('Doy fe que conozco toda la información necesaria para mi participación en el programa y que los campos requeridos, han sido marcados por mi persona.') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="px-4 py-3">
                        <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_nna_1">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_nna"
                                    id="form.autorizacion_nna_1"
                                    name="form.autorizacion_nna" type="radio" value="1" /><span class="text-club-nna">Sí</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.autorizacion_nna_0">
                                <x-forms.input-radio type="radio" wire:model="form.autorizacion_nna"
                                    id="form.autorizacion_nna_0"
                                    name="form.autorizacion_nna" type="radio" value="0"  /><span class="text-club-nna">No</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.autorizacion_nna')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="col-span-full" >
                    <label class="block text-club-nna sm:text-lg">
                        Se dará firma de autorización:
                        <x-required-label />
                    </label>
                    <div class="px-4 py-3">
                        <div class="flex flex-col gap-4">
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.firmaDigitalNna_1">
                                <x-forms.input-radio type="radio" wire:model="form.firmaDigitalNna"
                                    id="form.firmaDigitalNna_1"
                                    name="form.firmaDigitalNna" type="radio" value="1" /><span class="text-club-nna">Digital</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.firmaDigitalNna_0">
                                <x-forms.input-radio type="radio" wire:model="form.firmaDigitalNna"
                                    id="form.firmaDigitalNna_0"
                                    name="form.firmaDigitalNna" type="radio" value="0" /><span class="text-club-nna">Física</span>
                            </x-input-label>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-full flex flex-col items-center" x-cloak x-show="$wire.form.firmaDigitalNna == 1">
                    <div x-data="signaturePadNNA" x-init="init">
                        <div class="flex justify-center mt-8">
                            <canvas x-ref="signaturePadNNA" class="border border-gray-300 rounded-lg bg-white" width="400"
                                height="200"></canvas>
                        </div>
                        <div class="flex justify-center">
                            <button type="button" @click="clearCanvas"
                                class="px-4 py-2 mt-4 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                Limpiar Firma
                            </button>
                        </div>
                    </div>
                    
                    <p class="mt-4 text-lg leading-7 text-justify text-club-nna">
                        Firma de la niña, niño o adolescente 
                    </p>
                    <x-input-error :messages="$errors->get('form.signature_nna')" class="mt-2" aria-live="assertive" />
                </div>
                
            </div>


            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6"
                x-cloak
                x-show="$wire.form.deseo_participar == 1
                && $wire.form.uso_recoleccion_datos == 1
                && $wire.form.autorizacion_nna == 1">
                <div class="sm:col-span-full mt-5 mb-5">
                    <h2 class="text-2xl font-bold text-center mb-5">{{ __('Ficha de inscripción de participantes NNA') }}</h2>
                </div>
                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.nacionalidad"><span class="text-club-nna">{{ __('Selecciona tu nacionalidad:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="px-4 py-3">
                        <div class="flex gap-6">
                            <x-input-label class="flex items-center gap-2 sm:text-lg">
                                <x-forms.input-radio type="radio" wire:model="form.nacionalidad"
                                        id="form.nacionalidad_1"
                                        name="form.nacionalidad" type="radio" value="1" />
                                        <span class="text-club-nna">{{ $labels['nacionalidad'] }}</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-2 sm:text-lg">
                                <x-forms.input-radio type="radio" wire:model="form.nacionalidad"
                                id="form.nacionalidad_2"
                                name="form.nacionalidad" type="radio" value="2" />
                                <span class="text-club-nna">Extranjero(a)</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.nacionalidad')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3 text-justify">
                    <x-input-label class="sm:text-lg" for="form.ha_participado_anteriormente">
                        <span class="text-club-nna">{{ __('¿Has participado en años anteriores en actividades de Glasswing?') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.ha_participado_anteriormente" wire:model='form.ha_participado_anteriormente' id="form.ha_participado_anteriormente"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="['Sí', 'No']" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ha_participado_anteriormente'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.ha_participado_anteriormente')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.nombres">
                        <span class="text-club-nna">{{ __('Nombres Completo') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-text-input wire:model.live="form.nombres" id="form.nombres" name="form.nombres"
                            type="text"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.nombres'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ])
                            />
                        <x-input-error :messages="$errors->get('form.nombres')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>
                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.apellidos">
                        <span class="text-club-nna">{{ __('Apellidos Completo') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-text-input wire:model.live="form.apellidos" id="form.apellidos" name="form.apellidos"
                            type="text"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.apellidos'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ])
                            />
                        <x-input-error :messages="$errors->get('form.apellidos')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.fecha_nacimiento">
                        <span class="text-club-nna">{{ __('Escribe tu fecha de nacimiento:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-text-input  wire:model.lazy="form.fecha_nacimiento" id="form.fecha_nacimiento" name="form.fecha_nacimiento"
                            type="date"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}"
                            @class(['h-12 sm:text-lg', 'block w-full mt-1',
                                'border-2 border-red-500' => $errors->has('form.fecha_nacimiento'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ])
                        />
                        <x-input-error :messages="$errors->get('form.fecha_nacimiento')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.sexo">
                        <span class="text-club-nna">{{ __('Selecciona tu sexo según registro nacional:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="px-4 py-3">
                        <div class="flex gap-6">
                            <x-input-label class="flex items-center gap-2 sm:text-lg" for="form.sexo_1">
                                <x-forms.input-radio type="radio" wire:model="form.sexo"
                                    disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                    id="form.sexo_1"
                                    name="form.sexo" type="radio" value="1" class="h-12 sm:text-lg" /><span class="text-club-nna">Mujer</span>
                            </x-input-label>
                            <x-input-label class="flex items-center h-12 gap-2 sm:text-lg" for="form.sexo_2">
                                <x-forms.input-radio type="radio" wire:model="form.sexo"
                                    disabled="{{ $form->readonly ? 'disabled' : '' }}"
                                    id="form.sexo_2"
                                    name="form.sexo" type="radio" value="2" class="h-12 sm:text-lg" /><span class="text-club-nna">Hombre</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.sexo')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <x-input-label class="sm:text-lg" for="form.encuentras_estudiando">
                        <span class="text-club-nna">{{ __('¿El NNA se encuentra estudiando actualmente?') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="px-4 py-3">
                        <div class="flex grid-cols-2 gap-6 flex-col sm:flex-row">
                            <x-input-label class="flex items-center gap-4 h-12 sm:text-lg" for="form.encuentras_estudiando_1">
                                <x-forms.input-radio type="radio" wire:model="form.encuentras_estudiando"
                                    id="form.encuentras_estudiando_1"
                                    name="form.encuentras_estudiando" type="radio" value="1" /><span class="text-club-nna">Sí</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 h-12 sm:text-lg" for="form.encuentras_estudiando_0">
                                <x-forms.input-radio type="radio" wire:model="form.encuentras_estudiando"
                                    id="form.encuentras_estudiando_0"
                                    name="form.encuentras_estudiando" type="radio" value="0" /><span class="text-club-nna">No</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.encuentras_estudiando')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>
                <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando != 0"></div>

                <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 0">
                    <x-input-label class="sm:text-lg" for="form.ultimo_grado_alcanzado">
                        <span class="text-club-nna">{{ __('¿Último grado alcanzado?') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.ultimo_grado_alcanzado" wire:model='form.ultimo_grado_alcanzado' id="form.ultimo_grado_alcanzado"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$ultimosGrados" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ultimo_grado_alcanzado'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.ultimo_grado_alcanzado')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" >
                    <x-input-label class="sm:text-lg" for="form.posee_discapacidad">
                        <span class="text-club-nna">{{ __('¿Posees alguna discapacidad') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="px-4 py-3">
                        <div class="flex flex-col grid-cols-2 gap-6 sm:flex-row">
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.posee_discapacidad_1">
                                <x-forms.input-radio type="radio" wire:model.live="form.posee_discapacidad"
                                    id="form.posee_discapacidad_1" data-value="Si"
                                    name="form.posee_discapacidad" type="radio" value="1" /><span class="text-club-nna">Si</span>
                            </x-input-label>
                            <x-input-label class="flex items-center gap-4 sm:text-lg" for="form.posee_discapacidad_2">
                                <x-forms.input-radio type="radio" wire:model.live="form.posee_discapacidad"
                                    id="form.posee_discapacidad_2" data-value="No"
                                    name="form.posee_discapacidad" type="radio" value="2" /><span class="text-club-nna">No</span>
                            </x-input-label>
                        </div>
                        <x-input-error :messages="$errors->get('form.posee_discapacidad')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <div x-show="$wire.form.posee_discapacidad == 1">
                        <x-input-label class="sm:text-lg" for="form.inscripcion_discapacidad_id">
                            <span class="text-club-nna">{{ __('¿Cual?') }}</span>
                            <x-required-label />
                        </x-input-label>
                        <div class="px-4 py-3">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1">
                                @foreach ($discapacidades as $key => $value)
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <x-text-input type="checkbox"
                                            wire:key='inscripcionDiscapacidad{{$key}}'
                                            wire:model="form.discapacidadesSelect"
                                            value="{{ $key }}"
                                            class="w-5 h-5 text-indigo-600 border-gray-400 focus:ring-indigo-600"
                                            id="inscripcion-discapacidad-{{$key}}"
                                        />
                                    </div>
                                    <div class="leading-6 sm:text-lg">
                                        <label for="inscripcion-discapacidad-{{$key}}" class="sm:text-lg">{{ $value }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('form.discapacidadesSelect')" class="mt-2" aria-live="assertive" />
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3" >
                    <x-input-label class="sm:text-lg" for="form.sede_departamento_id">
                        <span class="text-club-nna">{{ $labels['departamento_escuela'] }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.sede_departamento_id" wire:model.live='form.sede_departamento_id' id="form.sede_departamento_id"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$departamentosReside" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.sede_departamento_id'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.sede_departamento_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" >
                    <x-input-label class="sm:text-lg" for="form.sede_ciudad_id">
                        <span class="text-club-nna">{{ $labels['minicipio_escuela'] }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.sede_ciudad_id" wire:model.live='form.sede_ciudad_id' id="form.sede_ciudad_id"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$form->laboraCiudades" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.sede_ciudad_id'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.sede_ciudad_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" >
                    <x-input-label class="sm:text-lg" for="form.sede_id">
                        <span class="text-club-nna">{{ __('Selecciona la sede/escuela a la que perteneces') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2 sm:text-lg">
                        <flux:select variant="listbox" searchable clear="close" selected-suffix="seleccionados"
                            id="filter3" name="filter2"  wire:model='form.sede_id'
                            placeholder="Selecciona una opción" class="text-indigo-900 border-indigo-500 focus:ring-indigo-500 sm:text-lg">
                            @foreach ($form->perteneceSede as $key => $value)
                                <flux:option class="sm:text-lg" value="{{ $key }}">{{ $value }}</flux:option>
                            @endforeach
                        </flux:select>
                        <x-input-error :messages="$errors->get('form.sede_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 1">
                    <x-input-label class="sm:text-lg" for="form.grado_id">
                        <span class="text-club-nna">{{ __('Selecciona tu grado actual:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.grado_id" wire:model='form.grado_id' id="form.grado_id"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$nivelesAcademicos" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.grado_id'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.grado_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 1">
                    <x-input-label class="sm:text-lg" for="form.seccion_id">
                        <span class="text-club-nna">{{ __('Selecciona tu sección:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.seccion_id" wire:model='form.seccion_id' id="form.seccion_id"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$secciones" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.seccion_id'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.seccion_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" x-show="$wire.form.encuentras_estudiando == 1">
                    <x-input-label class="sm:text-lg" for="form.turno_id">
                        <span class="text-club-nna">{{ __('Selecciona el turno o jornada en la que estudias:') }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.turno_id" wire:model='form.turno_id' id="form.turno_id"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$turnos" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.turno_id'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.turno_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" >
                    <x-input-label class="sm:text-lg" for="form.departamento">
                        <span class="text-club-nna">{{ $labels['departamento'] }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.departamento_id" wire:model.live='form.departamento_id' id="form.departamento_id"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$departamentos" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.departamento_id'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.departamento_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>

                <div class="sm:col-span-3" >
                    <x-input-label class="sm:text-lg" for="form.ciudad_id">
                        <span class="text-club-nna">{{ $labels['minicipio'] }}</span>
                        <x-required-label />
                    </x-input-label>
                    <div class="mt-2">
                        <x-forms.single-select name="form.ciudad_id" wire:model='form.ciudad_id' id="form.ciudad_id"
                            disabled="{{ $form->readonly ? 'disabled' : '' }}" 
                            :options="$form->ciudades" selected="Seleccione una opción" @class([ 'h-12 sm:text-lg',
                                'block w-full mt-1','border-2 border-red-500' => $errors->has('form.ciudad_id'),
                                'disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none' => $form->readonly,
                            ]) />
                        <x-input-error :messages="$errors->get('form.ciudad_id')" class="mt-2" aria-live="assertive" />
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end px-4 py-4  gap-x-6 sm:px-8 mt-5" x-cloak x-show="$wire.form.deseo_participar == 1
        && $wire.form.uso_recoleccion_datos == 1 && $wire.form.autorizacion_nna == 1">
            <button type="submit"
                class="relative w-full px-8 py-3 font-medium text-white rounded-lg bg-club-nna-bg-2 text-uppercase disabled:cursor-not-allowed disabled:opacity-75 ">
                GUARDAR
                <div wire:loading.flex wire:target="save"
                    class="absolute top-0 bottom-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </button>
        </div>
    </form>

    <x-notifications.modal-confirmacion-finalizar>
        <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">¡Proceso finalizado!</h3>
        <div class="mt-2">
            <p class="text-lg text-gray-500">
                Gracias {{ $form->nombres.' '.$form->apellidos }} por completar el proceso, su código de
                confirmación es: <span class="font-semibold">{{ $form->codigo_confirmacion }}</span>
            </p>
        </div>
    </x-notifications.modal-confirmacion-finalizar>


    <!-- Error Indicator... -->
    <x-notifications.error-text-notification message="Han habido errores en el formulario" />

    <!-- Error Alert... -->
    <x-notifications.alert-error-notification>
        <p class="text-sm font-medium text-red-900">¡Errores en el formulario!</p>
        <p class="mt-1 text-sm text-gray-500">Han habido problemas para guardar los cambios, corrija cualquier
            error en el formulario e intente nuevamente.</p>
    </x-notifications.alert-error-notification>
    <style>
        #filter3,
        ui-select,
        ui-selected,
        ui-options{
            font-size: 1.125rem;
            line-height: 1.75rem;
            color: #231D27;
        }
    </style>
</div>

@script
<script>
    Alpine.data('signaturePadNNA', () => ({
        canvas: null,
        ctx: null,
        drawing: false,
        hasDrawn: false,
        init() {
            this.canvas = this.$refs.signaturePadNNA;
            this.ctx = this.canvas.getContext('2d');
            this.setupCanvas();
            this.$wire.set('form.signature_nna', null);
        },
        setupCanvas() {
            this.canvas.addEventListener('mousedown', this.startDrawing.bind(this));
            this.canvas.addEventListener('mousemove', this.draw.bind(this));
            this.canvas.addEventListener('mouseup', this.stopDrawing.bind(this));
            this.canvas.addEventListener('mouseleave', this.stopDrawing.bind(this));
            this.canvas.addEventListener('touchstart', this.startDrawing.bind(this));
            this.canvas.addEventListener('touchmove', this.draw.bind(this));
            this.canvas.addEventListener('touchend', this.stopDrawing.bind(this));
            this.canvas.addEventListener('touchcancel', this.stopDrawing.bind(this));
        },
        startDrawing(event) {
            event.preventDefault();
            this.drawing = true;
            this.hasDrawn = false;
            this.ctx.beginPath();
            this.ctx.moveTo(this.getPos(event).x, this.getPos(event).y);
        },
        draw(event) {
            if (!this.drawing) return;
            event.preventDefault();
            this.ctx.lineTo(this.getPos(event).x, this.getPos(event).y);
            this.ctx.stroke();
            this.hasDrawn = true
        },
        stopDrawing() {
            this.drawing = false;
            if(this.hasDrawn){
                this.$wire.set('form.signature_nna', this.canvas.toDataURL('image/png'));
            }
            
        },
        clearCanvas(event) {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.$wire.set('form.signature_nna', null);
            this.hasDrawn = false;
            event.preventDefault();
        },
        getPos(event) {
            const rect = this.canvas.getBoundingClientRect();
            return {
                x: (event.touches ? event.touches[0].clientX : event.clientX) - rect.left,
                y: (event.touches ? event.touches[0].clientY : event.clientY) - rect.top
            };
        }
    }));

    Alpine.data('signaturePad', () => ({
        canvas: null,
        ctx: null,
        drawing: false,
        hasDrawn: false,
        init() {
            this.canvas = this.$refs.signaturePad;
            this.ctx = this.canvas.getContext('2d');
            this.setupCanvas();
            this.$wire.set('form.signature_responsable', null);
        },
        setupCanvas() {
            this.canvas.addEventListener('mousedown', this.startDrawing.bind(this));
            this.canvas.addEventListener('mousemove', this.draw.bind(this));
            this.canvas.addEventListener('mouseup', this.stopDrawing.bind(this));
            this.canvas.addEventListener('mouseleave', this.stopDrawing.bind(this));
            this.canvas.addEventListener('touchstart', this.startDrawing.bind(this));
            this.canvas.addEventListener('touchmove', this.draw.bind(this));
            this.canvas.addEventListener('touchend', this.stopDrawing.bind(this));
            this.canvas.addEventListener('touchcancel', this.stopDrawing.bind(this));
        },
        startDrawing(event) {
            event.preventDefault();
            this.drawing = true;
            this.hasDrawn = false;
            this.ctx.beginPath();
            this.ctx.moveTo(this.getPos(event).x, this.getPos(event).y);
        },
        draw(event) {
            if (!this.drawing) return;
            event.preventDefault();
            this.ctx.lineTo(this.getPos(event).x, this.getPos(event).y);
            this.ctx.stroke();
            this.hasDrawn = true
        },
        stopDrawing() {
            this.drawing = false;
            if(this.hasDrawn){
                this.$wire.set('form.signature_responsable', this.canvas.toDataURL('image/png'));
            }
        },
        clearCanvas(event) {
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            this.$wire.set('form.signature_responsable', null);
            this.hasDrawn = false;
            event.preventDefault();
        },
        getPos(event) {
            const rect = this.canvas.getBoundingClientRect();
            return {
                x: (event.touches ? event.touches[0].clientX : event.clientX) - rect.left,
                y: (event.touches ? event.touches[0].clientY : event.clientY) - rect.top
            };
        }
    }));
</script>
@endscript