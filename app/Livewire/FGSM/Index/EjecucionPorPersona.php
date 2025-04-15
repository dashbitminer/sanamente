<?php

namespace App\Livewire\FGSM\Index;

use App\Exports\EjecucionPorPersonaExport;
use Livewire\Component;
use App\Models\SeguimientoFormacionGeneral;
use Livewire\Attributes\Renderless;
use Livewire\WithPagination;

class EjecucionPorPersona extends Component
{

    use WithPagination;

    public $search = "";

    public $perPage = 10;

    public $pais;

    public $paisCodigo;

    //public $getSchoolsIds;


    #[Renderless]
    public function export()
    {
        if (!auth()->user()->can('Descargar seguimientos FGSM')){
            abort(404);
        }

        return \Maatwebsite\Excel\Facades\Excel::download(new EjecucionPorPersonaExport($this->pais, $this->paisCodigo, $this->search), 'resumen_ejecucion_por_persona.xlsx');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->pais = auth()->user()->pais_id;

        $this->paisCodigo = auth()->user()->pais->codigo;

    }

    public function render()
    {

        if (!auth()->user()->can('Resumen de ejecución por persona única')){
            abort(404);
        }

        $getSchoolsIds = \App\Models\EscuelaGWDATA::where('fkCodeCountry', $this->paisCodigo)->where('name', 'like', '%'.$this->search.'%')->pluck('id')->toArray();

        $this->search = trim($this->search);

        $records = SeguimientoFormacionGeneral::where("pais_id", $this->pais)
            ->when($this->search, function ($query) use ($getSchoolsIds) {
                $query->where("nombres", "like", "%{$this->search}%")
                    ->orWhere("apellidos", "like", "%{$this->search}%")
                    ->orWhere("codigo_confirmacion", "like", "%{$this->search}%")
                    ->orWhere("documento_identidad", "like", "%{$this->search}%")
                    ->orWhereIn('escuela_id', $getSchoolsIds)
                    ->orWhereHas("paisActividades.actividadSeguimiento", function ($query) {
                        $query->where("nombre", "like", "%{$this->search}%");
                    });
            })
            ->select("id", "nombres", "apellidos", "codigo_confirmacion", "escuela_id", "documento_identidad")
            ->withCount("paisActividades")
            ->with([
                "escuela:id,code,name"
            ])
           ->groupBy("codigo_confirmacion")
           ->paginate($this->perPage);

           // dd($records);

            foreach($records as $record){
                $record->record_gwdata = \App\Models\ParticipanteGWDATA::where('DNI', $record->documento_identidad)->where('fkCodeCountry', $this->paisCodigo)->exists() ? "SI" : "NO";
                $record->actividades = SeguimientoFormacionGeneral::where('codigo_confirmacion', $record->codigo_confirmacion)
                ->with('paisActividades.actividadSeguimiento:id,nombre')
                ->get()
                ->pluck('paisActividades')
                ->flatten()
                ->groupBy('actividadSeguimiento.id')
                ->map(function ($items) {
                    return [
                        'nombre' => $items->first()->actividadSeguimiento->nombre,
                        'count' => $items->count()
                    ];
                });
            }

//dd($records);

        return view('livewire.FGSM.index.ejecucion-por-persona', [
            'formularios' => $records
        ]);
    }


}
