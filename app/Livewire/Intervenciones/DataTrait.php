<?php

namespace App\Livewire\Intervenciones;

use App\Models\DepartamentoGWDATA;
use App\Models\EscuelaGWDATA;
use App\Models\DiscapacidadGWDATA;

trait DataTrait
{
    public function getData(): array
    {
        $perfilParticipante = $this->pais->perfilParticipante()
            ->whereNotNull('perfil_participantes.active_at')
            ->pluck('perfil_participantes.nombre', 'perfil_participantes.id');

        $departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSedesAndComponents($this->pais->codigo)
            ->pluck('name', 'fkCodeState');

        $tipoIntervencion = $this->pais->tipoIntervencion()
            ->whereNotNull('tipo_intervenciones.active_at')
            // ->where('tipo_intervenciones.nombre', '<>', 'Apoyo psicosocial nivel 2')
            ->pluck('tipo_intervenciones.nombre', 'tipo_intervenciones.id');

        $tipoOtraIntervencion = $this->pais->tipoOtraIntervencion()
            ->whereNotNull('tipo_otras_intervenciones.active_at')
            ->where('tipo_otras_intervenciones.id', '!=', 3)
            ->orderBy('tipo_otras_intervenciones.nombre')
            ->pluck('tipo_otras_intervenciones.nombre', 'tipo_otras_intervenciones.id');

        $tipoPsicoeducacion = $this->pais->tipoPsicoeducacion()
            ->whereNotNull('tipo_psicoeducaciones.active_at')
            ->pluck('tipo_psicoeducaciones.nombre', 'tipo_psicoeducaciones.id');

        $estrategia = $this->pais->estrategias()
            ->whereNotNull('estrategias.active_at')
            ->pluck('estrategias.nombre', 'estrategias.id');

        $pausoProtocolo = $this->pais->pausoProtocolo()
            ->whereNotNull('pauso_protocolos.active_at')
            ->pluck('pauso_protocolos.nombre', 'pauso_protocolos.id');

        $razonesIntervencion = $this->pais->razonIntervencion()
            ->whereNotNull('razon_intervenciones.active_at')
            ->pluck('razon_intervenciones.nombre', 'razon_intervenciones.id');

        $proceso = $this->pais->procesos()
            ->whereNotNull('procesos.active_at')
            ->pluck('procesos.nombre', 'procesos.id');

        $discapacidades = DiscapacidadGWDATA::where('name', '<>', 'Ninguna')
            ->pluck('name', 'id');

        return [
            'perfil_participante' => $perfilParticipante,
            'departamentos' => $departamentos,
            'tipo_intervencion' => $tipoIntervencion,
            'tipo_otras_intervenciones' => $tipoOtraIntervencion,
            'tipo_psicoeducacion' => $tipoPsicoeducacion,
            'estrategias' => $estrategia,
            'pauso_protocolos' => $pausoProtocolo,
            'razones' => $razonesIntervencion,
            'procesos' => $proceso,
            'discapacidades' => $discapacidades,
        ];
    }
}
