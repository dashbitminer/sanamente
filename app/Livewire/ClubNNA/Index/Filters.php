<?php

namespace App\Livewire\ClubNNA\Index;

use Livewire\Form;
use App\Models\Estado;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Livewire\ClubNNA\Index\Range;
use App\Models\EstadoRegistro;
use App\Models\EstadoRegistroParticipante;
use App\Models\ClubNNA;
use App\Models\Pais;

class Filters extends Form
{
    public $estados;

    public $status = 0;

    public $updatepage = false;

    #[Url]
    public Range $range = Range::All_Time;

    #[Url]
    public $start;

    #[Url]
    public $end;

    #[Url(as: 'estados')]
    public $selectedEstadosIds = [];

    public $departamentosSelected = [];

    public $municipiosSelected = [];

    public $escuelasSelected = [];

    public Pais $pais;



    public function resetFilters()
    {
        $this->departamentosSelected = [];

        $this->municipiosSelected = [];

        $this->escuelasSelected = [];

        $this->selectedEstadosIds = [1];

        $this->reset(['range', 'start', 'end']);
    }


    // public $escuelaSelected;


    public function init()
    {
        $this->initSelectedEstadosIds();

        $this->initRange();
    }


    public function estados()
    {
        $estados =  [
                ['id' => 1, 'nombre' => 'Registrado', 'color' => 'blue'],
                ['id' => 2, 'nombre' => 'Importado', 'color' => 'green'],
                ['id' => 3, 'nombre' => 'Eliminado', 'color' => 'red'],
            ];

            $registrados = ClubNNA::whereNull('imported_at')
                ->where('pais_id', $this->pais->id);

            if(!empty($this->escuelasSelected)){
                $registrados->whereIn('escuela_gwdata_id', $this->escuelasSelected);
            }elseif(!empty($this->municipiosSelected)){
                $registrados->whereIn('municipio_escuela_gwdata_code_municipality', $this->municipiosSelected);
            }elseif(!empty($this->departamentosSelected)){
                $registrados->whereIn('departamento_escuela_gwdata_code_state', $this->departamentosSelected);
            }


            $estados[0]["total"] = $registrados->count();

            $importados = ClubNNA::whereNotNull('imported_at')
            ->where('pais_id', $this->pais->id);

            if(!empty($this->escuelasSelected)){
                $importados->whereIn('escuela_gwdata_id', $this->escuelasSelected);
            }elseif(!empty($this->municipiosSelected)){
                $importados->whereIn('municipio_escuela_gwdata_code_municipality', $this->municipiosSelected);
            }elseif(!empty($this->departamentosSelected)){
                $importados->whereIn('departamento_escuela_gwdata_code_state', $this->departamentosSelected);
            }


            $estados[1]["total"] = $importados->count();

            $eliminados = ClubNNA::withTrashed()
                                        ->whereNotNull('deleted_at')
                                        ->where('pais_id', $this->pais->id);

            if(!empty($this->escuelasSelected)){
                $eliminados->whereIn('escuela_gwdata_id', $this->escuelasSelected);
            }elseif(!empty($this->municipiosSelected)){
                $eliminados->whereIn('municipio_escuela_gwdata_code_municipality', $this->municipiosSelected);
            }elseif(!empty($this->departamentosSelected)){
                $eliminados->whereIn('departamento_escuela_gwdata_code_state', $this->departamentosSelected);
            }



            $estados[2]["total"] = $eliminados->count();

            return $estados;
    }

    public function initSelectedEstadosIds()
    {
        if (empty($this->selectedEstadosIds)) {
            $this->selectedEstadosIds = [1];
        }
    }


    public function initRange()
    {
        if ($this->range !== Range::Custom) {
            $this->start = null;
            $this->end = null;
        }
    }

    public function apply($query)
    {
      $query = $this->applyRange($query);

      $query = $this->applyEstado($query);

      $query = $this->applyFilterBySchoolLocation($query);

       return $query;
    }


    public function applyFilterBySchoolLocation($query)
    {
        if (empty($this->escuelasSelected) && empty($this->municipiosSelected) && empty($this->departamentosSelected)) {
            return $query;
        }

        if(!empty($this->escuelasSelected)){
            return $query->whereIn('escuela_gwdata_id', $this->escuelasSelected);
        }elseif(!empty($this->municipiosSelected)){
            return $query->whereIn('municipio_escuela_gwdata_code_municipality', $this->municipiosSelected);
        }elseif(!empty($this->departamentosSelected)){
            return $query->whereIn('departamento_escuela_gwdata_code_state', $this->departamentosSelected);
        }
    }


    public function applyEstado($query)
    {


        if (count($this->selectedEstadosIds) == 1 && in_array(1, $this->selectedEstadosIds)) {
            return $query->whereNull('imported_at');
        }elseif(count($this->selectedEstadosIds) == 1 && in_array(2, $this->selectedEstadosIds)){
            return $query->whereNotNull('imported_at');
        }elseif(count($this->selectedEstadosIds) == 1 && in_array(3, $this->selectedEstadosIds)){
            return $query->withTrashed()
                     ->whereNotNull('deleted_at');
        }

        if(count($this->selectedEstadosIds) == 2 && in_array(1, $this->selectedEstadosIds) && in_array(2, $this->selectedEstadosIds)){
            return $query->where(function ($q) {
                    $q->whereNull('imported_at')
                        ->orWhereNotNull('imported_at');
                });
        }elseif(count($this->selectedEstadosIds) == 2 && in_array(1, $this->selectedEstadosIds) && in_array(3, $this->selectedEstadosIds)){
            return $query->withTrashed()->where(function ($q) {
                $q->whereNull('imported_at')
                ->orWhereNotNull('deleted_at');
            });
                        
        }elseif(count($this->selectedEstadosIds) == 2 && in_array(2, $this->selectedEstadosIds) && in_array(3, $this->selectedEstadosIds)){
            return $query->withTrashed()
                ->where(function ($q) {
                    $q->whereNotNull('imported_at')
                    ->orWhereNotNull('deleted_at');
                });
        }

        if(count($this->selectedEstadosIds) == 3){
            return $query->withTrashed();
        }

        

        return $query;
    }

    public function applyRange($query)
    {
        if ($this->range === Range::All_Time) {
            return $query;
        }

        if ($this->range === Range::Custom) {
            $start = Carbon::createFromFormat('Y-m-d', $this->start)->startOfDay();
            $end = Carbon::createFromFormat('Y-m-d', $this->end)->endOfDay();

           //return $query->whereBetween(DB::raw('CONVERT_TZ(created_at, "+00:00", "-06:00")'), [$start, $end]);

            return $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->whereBetween('created_at', $this->range->dates());
    }






}
