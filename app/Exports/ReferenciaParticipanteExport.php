<?php

namespace App\Exports;

use App\Models\EscuelaGWDATA;
use App\Models\MunicipioGWDATA;
use App\Models\DepartamentoGWDATA;
use App\Models\PaisInstitucionReferencia;
use App\Models\ReferenciaParticipante;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\SeguimientoFormacionGeneral;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReferenciaParticipanteExport implements FromQuery, WithMapping, WithHeadings
{

    use Exportable;

    public $selectedRecordIds;

    private $pais;

    private $edad;

    private $rowNumber = 1;

    public $operator;

    public function __construct(array $selectedRecordIds, $pais, $edad)
    {
        $this->selectedRecordIds = $selectedRecordIds;
        $this->pais = $pais;

        $this->edad = $edad;
    }

    public function query()
    {
        $this->operator = ( $this->menorDeEdad() ) ?  '>' : '<=';

        return ReferenciaParticipante::select('referencia_participantes.*')
        ->withCount('referencias') 
        ->addSelect([
            'institucion' => PaisInstitucionReferencia::select('institucion_referencias.nombre')
                ->join('institucion_referencias', 'pais_institucion_referencias.institucion_referencia_id', '=', 'institucion_referencias.id')
                ->join('referencias', 'pais_institucion_referencias.id', '=', 'referencias.pais_institucion_referencia_id')
                ->whereColumn('referencias.referencia_participante_id', 'referencia_participantes.id') 
                ->latest('referencias.id')
                ->limit(1),
            'servicios' => DB::table('tipo_servicios')
                ->selectRaw("GROUP_CONCAT(tipo_servicios.nombre SEPARATOR '\n ')")
                ->join('pais_tipo_servicios', 'tipo_servicios.id', '=', 'pais_tipo_servicios.tipo_servicio_id')
                ->join('referencia_pais_tipo_servicios', 'pais_tipo_servicios.id', '=', 'referencia_pais_tipo_servicios.pais_tipo_servicio_id')
                ->join('referencias', 'referencia_pais_tipo_servicios.referencia_id', '=', 'referencias.id')
                ->whereColumn('referencias.referencia_participante_id', 'referencia_participantes.id') 
                ->latest('referencias.id') 
                ->limit(1),
            'detalle_seguimiento' => DB::table('seguimiento_detalles')
                ->select('seguimiento_detalles.nombre')
                ->join('pais_seguimiento_detalles', 'seguimiento_detalles.id', '=', 'pais_seguimiento_detalles.seguimiento_detalle_id')
                ->join('referencia_seguimientos', 'pais_seguimiento_detalles.id', '=', 'referencia_seguimientos.pais_seguimiento_detalle_id')
                ->join('referencias', 'referencia_seguimientos.referencia_id', '=', 'referencias.id')
                ->whereColumn('referencias.referencia_participante_id', 'referencia_participantes.id')
                ->latest('referencia_seguimientos.id')
                ->limit(1)
        ])
        ->where('pais_id', $this->pais->id)
        ->where('fecha_nacimiento', $this->operator, Carbon::now()->subYears(18)->toDateString())
        ->when(!empty($this->selectedRecordIds), function ($query) {
            return $query->whereIn('id', $this->selectedRecordIds);
        });

    }

    public function headings(): array
    {
        return [
            '#',
            'Nombres',
            'Apellidos',
            'Institución a la que refiere',
            'Edad',
            '# de telefono',
            '# de Seguimientos',
            'Servicio',
            'Estado'
        ];
    }

    public function map($row): array
    {

        return [
            $this->rowNumber++, // #
            $row->nombres,
            $row->apellidos,
            $row->institucion ?? 'N/A',
            $row->edad(),
            $row->telefono,
            $row->referencias_count,
            $row->servicios,
            $row->detalle_seguimiento
        ];
    }

    private function menorDeEdad(){
        return $this->edad == 'menor';
    }
}
