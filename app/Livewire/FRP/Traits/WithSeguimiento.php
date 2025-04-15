<?php

namespace   App\Livewire\FRP\Traits;

use Illuminate\Validation\Rule;

trait WithSeguimiento
{
    public $ha_recibido_servicio;

    public $seguimiento_descripcion;

    public $pais_seguimiento_detalle_id;

    public $pais_seguimiento_paso_id;

    public $solicita_otra_referencia;

    public $seguimiento_comentario;


    protected function seguimientoRules(): array
    {
        return [
            'ha_recibido_servicio' => ['required'],
            'seguimiento_descripcion' => [
                Rule::requiredIf(function () {
                    return $this->ha_recibido_servicio == 1;
                })
            ],
            'pais_seguimiento_detalle_id' => [
                Rule::requiredIf(function () {
                    return $this->ha_recibido_servicio == 2;
                })
            ],
            'pais_seguimiento_paso_id' => [
                Rule::requiredIf(function () {
                    return $this->ha_recibido_servicio == 2;
                })
            ],
            'solicita_otra_referencia' => ['required'],
            'seguimiento_comentario' => [
                Rule::requiredIf(function () {
                    return $this->solicita_otra_referencia == 2;
                })
            ],
            
        ];
    }

    public function setSeguimiento(){
        $this->ha_recibido_servicio = $this->referenciaSeguimiento->ha_recibido_servicio;
        $this->seguimiento_descripcion = $this->referenciaSeguimiento->descripcion;
        $this->pais_seguimiento_detalle_id = $this->referenciaSeguimiento->pais_seguimiento_detalle_id;
        $this->pais_seguimiento_paso_id = $this->referenciaSeguimiento->pais_seguimiento_paso_id;
        $this->solicita_otra_referencia = $this->referenciaSeguimiento->solicita_otra_referencia;
        $this->seguimiento_comentario = $this->referenciaSeguimiento->comentario;
    }
}