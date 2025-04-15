<?php

namespace App\Livewire\FRP\Index;

use App\Exports\ReferenciaParticipanteExport;
use App\Models\Pais;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Reactive;
use App\Livewire\FRP\Index\Filters;
use App\Livewire\FRP\Index\Sortable;
use App\Livewire\FRP\Index\Searchable;
use App\Models\EscuelaGWDATA;
use App\Models\PaisInstitucionReferencia;
use App\Models\Referencia;
use App\Models\ReferenciaParticipante;
use App\Models\ReferenciaSeguimiento;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use PHPUnit\Framework\Attributes\Ticket;

class Table extends Component
{
    use WithPagination, Searchable, Sortable;

    public $selectedRecordIds = [];

    public $recordsIdsOnPage = [];

    public $selectedFormulario;

    public $perPage = 10;

    public Pais $pais;


    #[Reactive]
    public Filters $filters;

    public $edad;

    public $codigoPais;

    public $departamentos;

    public $municipios = [];

    public $departamentoSelected;

    public $municipioSelected;

    public $operator;

    public function export()
    {
        if(!auth()->user()->can('Descargar referencias RSAC')){
            abort(404);
        }      

        $filename_edad = ( $this->menorDeEdad() ) ?  'mayores_edad' : 'menores_edad';

        return (new ReferenciaParticipanteExport($this->selectedRecordIds, $this->pais, $this->edad))
        ->download('referencia_participantes_' .$filename_edad.'.xlsx');
    }

    public function mount()
    {
        $user = auth()->user()->load('pais');

        $this->codigoPais = $user->pais->codigo;

        $this->departamentos = EscuelaGWDATA::getUniqueStatesWithActiveSchoolsAndComponents($this->codigoPais)
        ->pluck('name', 'fkCodeState');

        $this->operator = ( $this->menorDeEdad() ) ?  '>' : '<=';
    }

    #[On('refresh-referencia-participantes')]
    public function render()
    {
        $this->operator = ( $this->menorDeEdad() ) ?  '>' : '<=';

        $query = ReferenciaParticipante::select('referencia_participantes.*')
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
                ->groupBy('referencias.referencia_participante_id')
                ->latest('referencias.id')
                ->limit(1),
            'detalle_seguimiento' => DB::table('seguimiento_detalles')
                ->select('seguimiento_detalles.nombre')
                ->join('pais_seguimiento_detalles', 'seguimiento_detalles.id', '=', 'pais_seguimiento_detalles.seguimiento_detalle_id')
                ->join('referencia_seguimientos', 'pais_seguimiento_detalles.id', '=', 'referencia_seguimientos.pais_seguimiento_detalle_id')
                ->join('referencias', 'referencia_seguimientos.referencia_id', '=', 'referencias.id')
                ->whereColumn('referencias.referencia_participante_id', 'referencia_participantes.id')
                ->latest('referencia_seguimientos.id')
                ->limit(1),
        ])
        ->where('pais_id', $this->pais->id)
        ->where('fecha_nacimiento', $this->operator, Carbon::now()->subYears(18)->toDateString());



        
        $query->when($this->departamentoSelected, function($query, $departamentoSelected){
            $query->where('departamento_id', $departamentoSelected);
        });

        $query->when($this->municipioSelected, function($query, $municipioSelected){
            $query->where('ciudad_id', $municipioSelected);
        });

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        $query = $this->filters->apply($query);

        $formularios = $query->paginate($this->perPage);

        $this->recordsIdsOnPage = $formularios->map(fn($formulario) => (string) $formulario->id)->toArray();

        return view('livewire.FRP.index.table', [
            'formularios' => $formularios
        ]);
    }

    public function delete(ReferenciaParticipante $referenciaParticipante)
    {  
        if(!auth()->user()->can('Eliminar referencia RSAC')){
            abort(404);
        }      
        $referenciaParticipante->delete();

        $this->dispatch('refresh-referencia-participantes');
    }


    public function deleteSelected()
    {
        if(!auth()->user()->can('Eliminar referencia RSAC')){
            abort(404);
        }      

        ReferenciaParticipante::whereIn('id', $this->selectedRecordIds)->each(function ($referenciaParticipante) {
                $this->delete($referenciaParticipante);
        });

        $this->selectedRecordIds = [];

        $this->dispatch('refresh-referencia-participantes');
    }

    public function updatedDepartamentoSelected($value)
    {
        $this->municipios = EscuelaGWDATA::getUniqueMunicipalitiesWithActiveSchoolsAndComponents($this->codigoPais, $value)
        ->pluck('name', 'codeMunicipality');
    }

    public function menorDeEdad(){
        return $this->edad == 'menor';
    }
}
