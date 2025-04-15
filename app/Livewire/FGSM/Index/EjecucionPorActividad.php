<?php

namespace App\Livewire\FGSM\Index;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Renderless;
use App\Models\PaisPerfilSeguimiento;
use App\Models\SeguimientoFormacionGeneral;

class EjecucionPorActividad extends Component
{

    public $pais;

    public function mount()
    {
        $this->pais = auth()->user()->pais_id;
    }

    #[Renderless]
    public function export()
    {
        if (!auth()->user()->can('Resumen de ejecución por actividad')){
            abort(404);
        }

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\EjecucionPorActividadExport($this->getEjecucionPorActividadData()), 'resumen_ejecucion_por_actividad.xlsx');
    }

    public function getEjecucionPorActividadData()
    {
        $data = SeguimientoFormacionGeneral::with([
                'paisActividades.actividadSeguimiento:id,nombre',
                'paisPerfilSeguimiento.perfilSeguimiento:id,nombre'
            ])
            ->select(
                'formacion_pais_actividad.pais_actividad_seguimiento_id',
                'actividad_seguimientos.nombre',
                DB::raw('COUNT(DISTINCT numero_grupo_participa) as unique_grupo_count'),
                DB::raw('COUNT(DISTINCT pais_perfil_seguimiento_id) as unique_perfil_count'),
                DB::raw('COUNT(*) as total_records')
            )
            ->where("seguimiento_formacion_generales.pais_id", $this->pais)
            ->join('formacion_pais_actividad', 'formacion_pais_actividad.seguimiento_formacion_general_id', '=', 'seguimiento_formacion_generales.id')
            ->join('pais_actividad_seguimientos', 'formacion_pais_actividad.pais_actividad_seguimiento_id', '=', 'pais_actividad_seguimientos.id')
            ->join('actividad_seguimientos', 'pais_actividad_seguimientos.actividad_seguimiento_id', '=', 'actividad_seguimientos.id')
            ->groupBy('formacion_pais_actividad.pais_actividad_seguimiento_id', 'actividad_seguimientos.nombre')
            ->get();

        foreach ($data as $record) {
            $record->unique_perfiles_count = collect($this->getUniquePerfilesCount($record->pais_actividad_seguimiento_id))->sortKeys()->toArray();
            $record->total_perfiles_count =  collect($this->getPerfilesWithRecordCount($record->pais_actividad_seguimiento_id))->sortKeys()->toArray();
        }

        return $data;
    }

    private function getUniquePerfilesCount($paisActividadSeguimientoId)
    {
        return SeguimientoFormacionGeneral::join('formacion_pais_actividad', 'formacion_pais_actividad.seguimiento_formacion_general_id', '=', 'seguimiento_formacion_generales.id')
            ->join('pais_actividad_seguimientos', 'formacion_pais_actividad.pais_actividad_seguimiento_id', '=', 'pais_actividad_seguimientos.id')
            ->join('pais_perfil_seguimientos', 'seguimiento_formacion_generales.pais_perfil_seguimiento_id', '=', 'pais_perfil_seguimientos.id')
            ->join('perfil_seguimientos', 'pais_perfil_seguimientos.perfil_seguimiento_id', '=', 'perfil_seguimientos.id')
            ->where('formacion_pais_actividad.pais_actividad_seguimiento_id', $paisActividadSeguimientoId)
            ->select('perfil_seguimientos.nombre', 'seguimiento_formacion_generales.codigo_confirmacion', DB::raw('COUNT(seguimiento_formacion_generales.pais_perfil_seguimiento_id) as count'))
            ->groupBy('seguimiento_formacion_generales.codigo_confirmacion')
            ->get();
           // ->pluck('count', 'nombre')
            //->dd();

    }



    private function getPerfilesWithRecordCount($paisActividadSeguimientoId)
    {
        return PaisPerfilSeguimiento::join('seguimiento_formacion_generales', 'seguimiento_formacion_generales.pais_perfil_seguimiento_id', '=', 'pais_perfil_seguimientos.id')
            ->join('perfil_seguimientos', 'pais_perfil_seguimientos.perfil_seguimiento_id', '=', 'perfil_seguimientos.id')
            ->join('formacion_pais_actividad', 'formacion_pais_actividad.seguimiento_formacion_general_id', '=', 'seguimiento_formacion_generales.id')
            ->where('formacion_pais_actividad.pais_actividad_seguimiento_id', $paisActividadSeguimientoId)
            ->select('perfil_seguimientos.nombre', DB::raw('COUNT(seguimiento_formacion_generales.id) as record_count'))
            ->groupBy('perfil_seguimientos.nombre')
            ->get()
            ->pluck('record_count', 'nombre')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.FGSM.index.ejecucion-por-actividad',[
            'actividades' => $this->getEjecucionPorActividadData()
        ]);
    }
}
