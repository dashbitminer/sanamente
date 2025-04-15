<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Intervencion;
use App\Models\DiscapacidadGWDATA;
use App\Models\PerfilParticipante;
use App\Models\EscuelaGWDATA;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Livewire\Intervenciones\Index\Sortable;
use App\Livewire\Intervenciones\Index\Searchable;

class IntervencionesExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    use Searchable;
    use Sortable;

    public $selectedRecordIds;

    private $pais;

    private $rowNumber = 1;

    public $filters;

    public $escuelaSelected;

    public $municipioSelected;

    public $departamentoSelected;

    public function __construct(
        array $selectedRecordIds,
        $pais,
        $filters,
        $search = '',
        $sortCol = null,
        $sortAsc = false,
        $escuelaSelected,
        $municipioSelected,
        $departamentoSelected
    ) {
        $this->selectedRecordIds = $selectedRecordIds;
        $this->pais = $pais;
        $this->filters = $filters;
        $this->search = $search;
        $this->sortCol = $sortCol;
        $this->sortAsc = $sortAsc;

        $this->escuelaSelected = $escuelaSelected;
        $this->municipioSelected = $municipioSelected;
        $this->departamentoSelected = $departamentoSelected;
    }

    public function query()
    {
        $query = Intervencion::with([
            "intervencionParticipante:id,nombres,apellidos,sexo,documento_identidad,codigo_confirmacion,fecha_nacimiento,telefono,email,nacionalidad",
            "tipoIntervencion:id,nombre",
            "sede:id,name,code,fkCodeCountry,fkCodeState,fkCodeMunicipality",
            "sede.municipio:id,name,codeMunicipality,fkCodeState",
            "sede.departamento:id,codeState,name,fkCodeCountry",
            "tipoOtraIntervencion",
            "perfilParticipante:id,nombre",
            "protocoloSanamente",
            "protocoloSanamente.tipoPsicoeducacion",
            "protocoloSanamente.estrategia",
            "protocoloSanamente.pausoProtocolo",
            "protocoloSanamente.intervencionImages",
            "primerAuxilioPsicologico",
            "referenciaIntervencion",
            "referenciaIntervencion.razonIntervencion",
            "referenciaIntervencion.referenciasProcesos",
            "referenciaIntervencion.intervencionImages",
            "creator",
        ])
        ->where('pais_id', $this->pais->id)
        ->when(!empty($this->selectedRecordIds), function ($query) {
            return $query->whereIn('id', $this->selectedRecordIds);
        })
        ->when($this->escuelaSelected && $this->escuelaSelected != "-1", function ($query) {

            return $query->where('sede_id', $this->escuelaSelected);

        })
        ->when($this->municipioSelected, function ($query) {

            $escuelas = EscuelaGWDATA::select('id')
                ->where('fkCodeMunicipality', $this->municipioSelected)
                ->get()
                ->pluck('id')
                ->toArray();

            return $query->whereIn('sede_id', $escuelas);

        })
        ->when($this->departamentoSelected, function ($query) {

            $escuelas = EscuelaGWDATA::select('id')
                ->where('fkCodeState', $this->departamentoSelected)
                ->get()
                ->pluck('id')
                ->toArray();

            return $query->whereIn('sede_id', $escuelas);

        })
        ->orderBy('intervenciones.created_at', 'DESC');

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $query = $this->filters->apply($query);

        return $query;
    }

    public function headings(): array
    {
        return [
            '#',
            'Código de Registro',
            'La intervención es',
            'Hombres',
            'Mujeres',
            'Primera Intervención Recibida',
            'Compartir Información Personal',
            'Nacional o Extranjero(a)',
            'Documento de Identidad',
            'Nombres',
            'Apellidos',
            'Fecha Nacimiento',
            'Sexo',
            'Discapacidad',
            'Cuales?',
            'Perfil Participante',
            'Departamento de la sede de intervención',
            'Municipio de la sede de intervención',
            'Sede de intervención',
            'Fecha de intervención',
            'Tipo de Intervención',

            'Inicio de la intervención',
            'Fin de la intervención',
            'Total de minutos de la intervención',

            // Protocolo Sanamente
            'Tipo de psicoeducación',
            'Estrategia',
            'Se pausó el protocolo',
            'Porque',
            'Otros motivos',
            'Cuánto tiempo se pausó el protocolo',
            'Consentimiento informado de la persona',
            'Consentimiento informado de la persona 2',
            'Consentimiento informado de la persona 3',
            'Comentarios adicionales del protocolo SanaMente',
            'La persona fue referida',

            // Primeros Auxilios Psicologicos
            'Otras intervenciones',
            'Comentarios adicionales de primeros auxilios psicológicos',
            'Consentimiento informado de la persona',

            // Referencia
            'Se realizó la conceptualización del problema',
            'Selecciona la razón por la que no se realizó la intervención',
            'Otros',
            'Qué procesos se activaron a partir de la referencia',
            'Otros',
            'Documento de respaldo de la referencia',
            'Documento de respaldo de la referencia 2',
            'Documento de respaldo de la referencia 3',
            'Comentarios adicionales de referencia',

            // Apoyo psicosocial
            'Comentarios adicionales de apoyo psicosocial',

            'Recontacto',
            'Telefono',
            'Correo Electronico',
            'Registrado Por'
        ];
    }

    public function map($row): array
    {
        $codigo_confirmacion = $row->intervencionParticipante->codigo_confirmacion ?? $row->codigo_confirmacion;

        // Consentimientos archivos
        $consentimiento = [];

        if ($row->protocoloSanamente?->consentimiento) {
            if (str_contains($row->protocoloSanamente->consentimiento, 'intervenciones/protocolo-sanamente')) {
                $consentimiento[1] = Storage::disk('s3')->temporaryUrl($row->protocoloSanamente->consentimiento, Carbon::now()->addHour());
            } else {
                $consentimiento[1] = Storage::url($row->protocoloSanamente->consentimiento);
            }
        }

        if ($row->protocoloSanamente?->intervencionImages()->count()) {
            foreach ($row->protocoloSanamente->intervencionImages()->get() as $files) {
                $consentimiento[] = Storage::disk('s3')->temporaryUrl($files->url, Carbon::now()->addHour());
            }
        }


        // Referencias archivos
        $referencias = [];

        if ($row->referenciaIntervencion?->referencia) {
            if (str_contains($row->referenciaIntervencion->referencia, 'intervenciones/protocolo-sanamente')) {
                $referencias[1] = Storage::disk('s3')->temporaryUrl($row->referenciaIntervencion->referencia, Carbon::now()->addHour());
            } else {
                $referencias[1] = Storage::url($row->referenciaIntervencion->referencia);
            }
        }

        if ($row->referenciaIntervencion?->intervencionImages()->count()) {
            foreach ($row->referenciaIntervencion->intervencionImages()->get() as $files) {
                $referencias[] = Storage::disk('s3')->temporaryUrl($files->url, Carbon::now()->addHour());
            }
        }

        $hideInfo = $row->compartir_informacion != 1;


        $discapacidades = '';

        if ($row->discapacidad == 1) {
            $discapacidades = DiscapacidadGWDATA::whereIn('id', json_decode($row->discapacidad_id))
                ->pluck('name')
                ->join(', ');
        }

        $perfil_participante = '';

        if (!empty($row->perfilParticipante)) {
            $perfil_participante = $row->perfilParticipante->nombre;
        }
        else {
            $perfil_participante = PerfilParticipante::whereIn('id', json_decode($row->perfil_participante))
                ->pluck('nombre')
                ->join(', ');
        }


        return [
            $this->rowNumber++, // #
            $codigo_confirmacion,
            $row->tipo_intervencion != 2 ? 'Individual' : 'Grupal',
            $row->cantidad_hombres,
            $row->cantidad_mujeres,
            $row->primera_intervencion == 1 ? 'Si' : 'No',
            $row->compartir_informacion == 1 ? 'Si' : 'No',
            $hideInfo ? null : ($row->intervencionParticipante->nacionalidad == 1 ? 'Nacional' : 'Extranjero'),
            $hideInfo ? null : $row->intervencionParticipante->documento_identidad,
            $hideInfo ? null : $row->intervencionParticipante->nombres,
            $hideInfo ? null : $row->intervencionParticipante->apellidos,
            $hideInfo ? null : $row->intervencionParticipante->fecha_nacimiento,
            $row->tipo_intervencion != 2 ? ($row->intervencionParticipante->sexo == 1 ? 'Mujer' : 'Hombre')
                                         : 'NA',
            $row->discapacidad == 1 ? 'Si' : 'No',
            $discapacidades,
            $perfil_participante,
            $row->sede->departamento->name ?? null,
            $row->sede->municipio->name ?? null,
            $row->sede->name ?? null,
            $row->fecha_intervencion,
            $row->tipoIntervencion->pluck('nombre')->join(', '),

            $row->inicio_intervencion ?? null,
            $row->fin_intervencion ?? null,
            $row->total_intervencion ?? null,

            // Protocolo Sanamente
            $row->protocoloSanamente?->tipoPsicoeducacion()->pluck('nombre')->join(', ') ?? null,
            $row->protocoloSanamente?->estrategia->pluck('nombre')->join(', ') ?? null,
            isset($row->protocoloSanamente) ? ($row->protocoloSanamente->pauso_protocolo == 1 ? 'Si' : 'No')
                                            : null,
            $row->protocoloSanamente?->pausoProtocolo->nombre ?? null,
            $row->protocoloSanamente?->pauso_protocolo_otros ?? null,
            $row->pauso_intervencion ?? null,
            $consentimiento[1] ?? null,
            $consentimiento[2] ?? null,
            $consentimiento[3] ?? null,
            $row->protocoloSanamente?->comentario ?? null,
            isset($row->persona_referida) ? ($row->persona_referida == 1 ? 'Si' : 'No')
                                          : null,
            // Primeros Auxilios Psicologicos
            $row?->tipoOtraIntervencion()->pluck('nombre')->join(', ') ?? null,
            $row->primerAuxilioPsicologico?->comentario ?? null,
            $row->primerAuxilioPsicologico?->consentimiento ?? null,

            // Referencia
            isset($row->referenciaIntervencion) ? ($row->referenciaIntervencion->conceptualizacion_problema == 1 ? 'Si' : 'No')
                                                : null,
            $row->referenciaIntervencion?->razonIntervencion->name ?? null,
            $row->referenciaIntervencion?->razon_otro ?? null,
            $row->referenciaIntervencion?->referenciasProcesos()->pluck('nombre')->join(', ') ?? null,
            $row->referenciaIntervencion?->proceso_otro ?? null,
            $referencias[1] ?? null,
            $referencias[2] ?? null,
            $referencias[3] ?? null,
            $row->referenciaIntervencion?->referencias_comentario ?? null,

            // Apoyo psicosocial
            $row->comentario_apoyo_psicosocial ?? null,

            $row->participar_proceso_evaluacion == 1 ? 'Si' : 'No',
            $row->intervencionParticipante->telefono,
            $row->intervencionParticipante->email,

            $row->creator->name ?? ''
        ];
    }
}
