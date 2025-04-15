<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\SeguimientoFormacionGeneral;

class EjecucionPorPersonaExport implements FromView
{

    protected $data;
    protected $pais;
    protected $paisCodigo;
    protected $search;

    public function __construct($pais, $paisCodigo, $search)
    {
        $this->pais = $pais;
        $this->paisCodigo = $paisCodigo;
        $this->search = $search;
    }

    public function view(): View
    {
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
            ->get();
            //->paginate($this->perPage);

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
        return view('livewire.FGSM.exports.ejecucion-por-persona', [
            'formularios' => $records
        ]);
    }
}
