<?php

namespace App\Livewire\Inscripcion\Index;

use Livewire\Form;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Livewire\Intervenciones\Index\Range;
use App\Models\Inscripcion;
use App\Models\Pais;

class Filters extends Form
{
    public ?Pais $pais;

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


    public function resetFilters()
    {
        $this->departamentosSelected = [];

        $this->municipiosSelected = [];

        $this->escuelasSelected = [];

        $this->selectedEstadosIds = [1];

        $this->reset(['range', 'start', 'end']);
    }


    public function initSelectedEstadosIds()
    {
        if (empty($this->selectedEstadosIds)) {
            $this->selectedEstadosIds = [1, 2];
        }
    }

    public function initRange()
    {
        if ($this->range !== Range::Custom) {
            $this->start = null;
            $this->end = null;
        }
    }

    public function init(?Pais $pais = null)
    {
        $this->initSelectedEstadosIds();

        $this->initRange();

        $this->pais = $pais ?? null;
    }

    public function estados()
    {
        $estados =  [
                ['id' => 1, 'nombre' => 'Registrado', 'color' => 'blue'],
                ['id' => 2, 'nombre' => 'Importado', 'color' => 'green'],
                ['id' => 3, 'nombre' => 'Eliminado', 'color' => 'red'],
            ];

            $registrados = Inscripcion::whereNull('imported_at');

            if ($this->pais) {
                $registrados->where('pais_id', $this->pais->id);
            }

            if(!empty($this->escuelasSelected)){
                $registrados->whereIn('pertenece_sede_id', $this->escuelasSelected);
            }elseif(!empty($this->municipiosSelected)){
                $registrados->whereIn('pertenece_ciudad_id', $this->municipiosSelected);
            }elseif(!empty($this->departamentosSelected)){
                $registrados->whereIn('pertenece_departamento_id', $this->departamentosSelected);
            }


            $estados[0]["total"] = $registrados->count();

            $importados = Inscripcion::whereNotNull('imported_at');

            if ($this->pais) {
                $importados->where('pais_id', $this->pais->id);
            }

            if(!empty($this->escuelasSelected)){
                $importados->whereIn('pertenece_sede_id', $this->escuelasSelected);
            }elseif(!empty($this->municipiosSelected)){
                $importados->whereIn('pertenece_ciudad_id', $this->municipiosSelected);
            }elseif(!empty($this->departamentosSelected)){
                $importados->whereIn('pertenece_departamento_id', $this->departamentosSelected);
            }


            $estados[1]["total"] = $importados->count();

            $eliminados = Inscripcion::withTrashed()->whereNotNull('deleted_at');

            if ($this->pais) {
                $eliminados->where('pais_id', $this->pais->id);
            }

            if(!empty($this->escuelasSelected)){
                $eliminados->whereIn('pertenece_sede_id', $this->escuelasSelected);
            }elseif(!empty($this->municipiosSelected)){
                $eliminados->whereIn('pertenece_ciudad_id', $this->municipiosSelected);
            }elseif(!empty($this->departamentosSelected)){
                $eliminados->whereIn('pertenece_departamento_id', $this->departamentosSelected);
            }



            $estados[2]["total"] = $eliminados->count();

            return $estados;
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
            return $query->whereIn('pertenece_sede_id', $this->escuelasSelected);
        }elseif(!empty($this->municipiosSelected)){
            return $query->whereIn('pertenece_ciudad_id', $this->municipiosSelected);
        }elseif(!empty($this->departamentosSelected)){
            return $query->whereIn('pertenece_departamento_id', $this->departamentosSelected);
        }
    }

    public function applyEstado($query)
    {
        if (in_array(3, $this->selectedEstadosIds)) {
            $query->withTrashed();
        }

        return $query->where(function (Builder $builder) {
            if (count($this->selectedEstadosIds) == 1) {
                if (in_array(1, $this->selectedEstadosIds)) {
                    $builder->whereNull('imported_at');
                } elseif (in_array(2, $this->selectedEstadosIds)) {
                    $builder->whereNotNull('imported_at');
                } elseif (in_array(3, $this->selectedEstadosIds)) {
                    $builder->whereNotNull('deleted_at');
                }
            } elseif (count($this->selectedEstadosIds) == 2) {
                if (in_array(1, $this->selectedEstadosIds) && in_array(2, $this->selectedEstadosIds)) {
                    $builder->whereNull('imported_at')
                            ->orWhereNotNull('imported_at');
                } elseif (in_array(1, $this->selectedEstadosIds) && in_array(3, $this->selectedEstadosIds)) {
                    $builder->whereNull('imported_at')
                            ->orWhereNotNull('deleted_at');
                } elseif (in_array(2, $this->selectedEstadosIds) && in_array(3, $this->selectedEstadosIds)) {
                    $builder->whereNotNull('imported_at')
                            ->orWhereNotNull('deleted_at');
                }
            }
        });
    }

    public function applyRange($query)
    {
        if ($this->range === Range::All_Time) {
            return $query;
        }

        if ($this->range === Range::Custom) {
            $start = Carbon::createFromFormat('Y-m-d', $this->start)->startOfDay();
            $end = Carbon::createFromFormat('Y-m-d', $this->end)->endOfDay();

            return $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->whereBetween('created_at', $this->range->dates());
    }

}
