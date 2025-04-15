<?php

namespace App\Livewire\Intervenciones\Create;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Livewire\Intervenciones\DataTrait;
use App\Livewire\Intervenciones\Forms\IntervencionForm;
use App\Models\Pais;
use App\Models\EscuelaGWDATA;
use App\Models\Intervencion;
use App\Models\IntervencionParticipante;
use App\Models\IntervencionImage;
use Illuminate\Support\Carbon;

class Page extends Component
{
    use WithFileUploads, DataTrait;

    public IntervencionForm $form;

    public Pais $pais;

    public bool $showSuccessIndicator = false;

    public $data;

    public function mount(?Intervencion $intervencion)
    {
        $this->form->init($this->pais);

        $this->data = $this->getData();
    }

    public function updated($property, $value)
    {
        switch ($property) {
            case 'form.nacionalidad':
                if ($value == IntervencionParticipante::NACIONAL) {
                    $this->form->dni_placeholder = $this->form->setCountry($this->pais)->getPlaceholder();
                    $this->form->dni_mask = $this->form->setCountry($this->pais)->getMask();
                    $this->form->dni_title = 'Escribe tu número documento unico de identidad:';
                }

                if ($value == IntervencionParticipante::EXTRANJERO) {
                    $this->form->dni_placeholder = '';
                    $this->form->dni_mask = '';
                    $this->form->dni_title = IntervencionForm::DNI_TITLE;
                }
                break;

            case 'form.documento_identidad':
                if (!empty($this->form->documento_identidad)) {
                    $intervencionParticipante = IntervencionParticipante::with('intervenciones')
                        ->active()
                        ->whereLike('documento_identidad', $this->form->documento_identidad . '%')
                        ->orWhereLike('intervencion_participantes.codigo_confirmacion', $this->form->documento_identidad . '%')
                        ->orWhereHas('intervenciones', function ($query) {
                            $query->whereLike('codigo_confirmacion', $this->form->documento_identidad . '%');
                        })
                        ->first();

                    if ($this->form->isCondicion1()) {
                        if ($intervencionParticipante) {
                            $this->form->setIntervencionParticipante($intervencionParticipante);

                            $this->setCiudad($this->form->departamento_id);
                            $this->setSede($this->form->ciudad_id);
                            $this->dispatch('load-intervencion-ciudad-sede');
                        }
                    }

                    if ($this->form->isCondicion2()) {
                        if ($intervencionParticipante) {
                            $this->form->setIntervencionParticipante($intervencionParticipante);
                            $this->form->nombres = null;
                            $this->form->apellidos = null;
                            $this->form->nacionalidad = null;
                            $this->form->fecha_nacimiento = null;

                            $this->setCiudad($this->form->departamento_id);
                            $this->setSede($this->form->ciudad_id);
                            $this->dispatch('load-intervencion-ciudad-sede');
                        }
                    }
                }
                break;

            case 'form.departamento_id':
                $this->setCiudad($value);
                break;

            case 'form.ciudad_id':
                $this->setSede($value);
                break;

            case 'form.inicio_intervencion':
            case 'form.fin_intervencion':
            case 'form.pauso_intervencion':
                $pattern = '/^([0-9]{2}):([0-9]{2})(:?)([0-9]{2}?)$/';

                if (!empty($this->form->inicio_intervencion) && !empty($this->form->fin_intervencion)) {
                    $inicio_intervencion = preg_replace($pattern, '$1:$2', $this->form->inicio_intervencion);
                    $fin_intervencion = preg_replace($pattern, '$1:$2', $this->form->fin_intervencion);

                    $inicioIntervencion = Carbon::createFromTimeString("{$inicio_intervencion}:00");
                    $finIntervencion = Carbon::createFromTimeString("{$fin_intervencion}:00");

                    if ($inicioIntervencion > $finIntervencion || $inicioIntervencion == $finIntervencion) {
                        $this->addError(
                            'form.fin_intervencion',
                            'El fin de la intervención debe ser mayor a la inicio de la intervención.'
                        );
                    }

                    $totalMinutes = $inicioIntervencion->diffInMinutes($finIntervencion);

                    if (!empty($this->form->pauso_intervencion)) {
                        $pauso_intervencion = preg_replace($pattern, '$1:$2', $this->form->pauso_intervencion);
                        [$hour, $minute] = explode(':', $pauso_intervencion);

                        // Validar hora no mas de 23
                        if ($hour > 23) {
                            $this->addError(
                                'form.pauso_intervencion',
                                'La hora de pausa no puede ser mayor a 23.'
                            );

                            return;
                        }

                        if ($minute > 59) {
                            $this->addError(
                                'form.pauso_intervencion',
                                'Los minutos de pausa no puede ser mayor a 59.'
                            );

                            return;
                        }

                        $pausoIntervencion = Carbon::createFromTimeString("{$pauso_intervencion}:00");
                        $minutosPausa = $pausoIntervencion->hour * 60 + $pausoIntervencion->minute;

                        if ($minutosPausa) {
                            $totalMinutes -= $minutosPausa;
                        }

                        if ($totalMinutes < 0) {
                            $this->addError(
                                'form.pauso_intervencion',
                                'La pausa de la intervención supera el total de minutos de la intervención.'
                            );
                        }
                    }

                    // Convert minutes to hours and remaining minutes
                    $hours = intval($totalMinutes / 60);
                    $minutes = $totalMinutes % 60;

                    // Validacion para el total de intervencion
                    $this->form->is_negative_total_intervencion_hora = $hours < 0;
                    $this->form->is_negative_total_intervencion_minuto = $minutes < 0;

                    $this->form->total_intervencion = $hours . 'h ' . $minutes . 'm';
                }
                break;

            // case 'form.fecha_nacimiento':
                // $current = Carbon::today($this->pais->timezone);
                // $birthday = Carbon::createFromDate($value);

                // $this->form->menor = $birthday->diffInYears($current) < 18;

                // if ($this->form->menor) {
                //     $this->addError('form.fecha_nacimiento', 'Debes tener al menos 18 años.');
                // }
                // break;

            case 'form.fecha_intervencion':
                $current = Carbon::today($this->pais->timezone);

                $fechaIntervencion = Carbon::createFromFormat('Y-m-d', $value, $this->pais->timezone);
                $fechaIntervencion->setHour(0)->setMinute(0)->setSecond(0);

                if ($fechaIntervencion > $current) {
                    $this->addError('form.fecha_intervencion', 'La fecha de intervención no puede ser mayor a la fecha actual.');
                }
                break;

            case 'form.tipo_intervencion':

                if ($this->form->tipo_intervencion == 2) {
                    $this->data['tipo_intervencion'] = $this->data['tipo_intervencion']->filter(function ($item, $key) {
                        return in_array($key, [2, 4]);
                    });
                }
                else {
                    $this->data['tipo_intervencion'] = $this->pais->tipoIntervencion()
                        ->whereNotNull('tipo_intervenciones.active_at')
                        ->pluck('tipo_intervenciones.nombre', 'tipo_intervenciones.id');
                }

                break;

            default:
                break;
        }
    }

    public function setCiudad($departamento_id)
    {
        $this->form->ciudades = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSedesAndComponents(
            $this->pais->codigo,
            $departamento_id
            )
            ->pluck('name', 'codeMunicipality');
    }

    public function setSede($ciudad_id)
    {
        $this->form->sedes = EscuelaGWDATA::getActiveSedes(
            $this->pais->codigo,
            $ciudad_id
            )
            ->pluck('name', 'id');

        $this->dispatch('refresh-choices', $this->form->sedes);
    }

    #[Layout('layouts.intervenciones-directas')]
    public function render()
    {
        return view('livewire.intervenciones.create.page', $this->data);
    }

    public function save()
    {
        $this->form->save();
        $this->showSuccessIndicator = true;

        $this->form->init($this->pais);
        $this->dispatch('refresh-choices', $this->form->sedes);
        $this->dispatch('reset-intervencion-form', $this->form->sedes);
    }

    public function addReferenciaImage()
    {
        $this->form->referencia_images[] = null;
    }

    public function removeReferenciaImage($key)
    {
        unset($this->form->referencia_images[$key]);
    }

    public function deleteReferenciaImage($key)
    {
        unset($this->form->referencia_images[$key]);
        unset($this->form->referencia_images_uploaded[$key]);

        $intervencionImage = IntervencionImage::find($key);
        $intervencionImage->delete();
    }

    public function addProtocoloImage()
    {
        $this->form->protocolo_images[] = null;
    }

    public function removeProtocoloImage($key)
    {
        unset($this->form->protocolo_images[$key]);
    }

    public function deleteProtocoloImage($key)
    {
        unset($this->form->protocolo_images[$key]);
        unset($this->form->protocolo_images_uploaded[$key]);

        $intervencionImage = IntervencionImage::find($key);
        $intervencionImage->delete();
    }
}
