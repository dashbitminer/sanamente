<?php

namespace App\Exports;

use App\Models\EscuelaGWDATA;
use App\Models\MunicipioGWDATA;
use App\Models\DepartamentoGWDATA;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\SeguimientoFormacionGeneral;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SeguimientoFormacionExport implements FromQuery, WithMapping, WithHeadings
{

    use Exportable;

    public $selectedRecordIds;

    private $pais;

    private $rowNumber = 1;

    public function __construct(array $selectedRecordIds, $pais)
    {
        $this->selectedRecordIds = $selectedRecordIds;
        $this->pais = $pais;
    }

    public function query()
    {
        return SeguimientoFormacionGeneral::with([
            "paisPerfilSeguimiento:id,perfil_seguimiento_id,pais_id",
            "paisPerfilSeguimiento.perfilSeguimiento:id,nombre",
            "escuela:id,name,code,fkCodeCountry,fkCodeState,fkCodeMunicipality",
            "escuela.municipio:id,name,codeMunicipality,fkCodeState",
            "escuela.departamento:id,codeState,name,fkCodeCountry",
            "paisActividades:id,actividad_seguimiento_id",
            "paisActividades.actividadSeguimiento:id,nombre"
        ])
        ->where('pais_id', $this->pais->id)
        ->when(!empty($this->selectedRecordIds), function ($query) {
            return $query->whereIn('id', $this->selectedRecordIds);
        });

    }

    public function headings(): array
    {
        return [
            '#',
            'Código de registro',
            'Nombres',
            'Apellidos',
            'Documento de identidad',
            'Primera participación',
            'Nacionalidad',
            'Perfil de seguimiento',
            'Perfil docente',
            'Perfil policia',
            'Rango/categoría',
            'Perfil organizaciones',
            'Perfil salud',
            'Perfil personal de salud',
            'Municipio',
            'Departamento',
            'Sede/Escuela',
            'Actividades',
            'Grupo en el que participa',
        ];
    }

    public function map($row): array
    {
        $escuela = EscuelaGWDATA::with("departamento:codeState,name", "municipio:codeMunicipality,name")
                                ->select('name', 'fkCodeState', 'fkCodeMunicipality')
                                ->find($row->escuela_id);

        return [
            $this->rowNumber++, // #
            $row->codigo_confirmacion,
            $row->nombres,
            $row->apellidos,
            $row->documento_identidad,
            $row->primera_participacion,
            $row->nacionalidad == 1 ? "Nacional" : "Extranjero",
            $row->paisPerfilSeguimiento->perfilSeguimiento->nombre,
            $row->paisPerfilSeguimientoDocente->perfilSeguimientoDocente->nombre ?? null,
            $row->paisPerfilSeguimientoPolicia->perfilSeguimientoPolicia->nombre ?? null,
            $row->paisRangoSeguimientoPolicia->rangoSeguimientoPolicias->nombre ?? null,
            $row->paisPerfilSeguimientoOrganizacion->perfilSeguimientoOrganizacion->nombre ?? null,
            $row->paisPerfilSeguimientoSalud->perfilSeguimientoSalud->nombre ?? null,
            $row->paisPerfilSeguimientoHospital->perfilSeguimientoHospital->nombre ?? null,
            $escuela->municipio->name ?? null,
            $escuela->departamento->name ?? null,
            $escuela->name ?? null,
            $row->paisActividades->pluck('actividadSeguimiento.nombre')->implode(', '),
            $row->numero_grupo_participa,
        ];
    }
}
