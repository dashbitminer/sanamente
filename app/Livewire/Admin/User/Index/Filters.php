<?php

namespace App\Livewire\Admin\User\Index;

use Livewire\Form;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use App\Livewire\FGSM\Index\Range;

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

    public $paisSelected = [];

    public $rolSelected = [];


    public function init()
    {
        $this->initSelectedEstadosIds();
        $this->initRange();
    }


    public function estados()
    {
        $estados = [];
        return $estados;
    }

    public function initSelectedEstadosIds()
    {
        
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
      $query = $this->applyPais($query);
      $query = $this->applyRol($query);


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

            return $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->whereBetween('created_at', $this->range->dates());
    }


    public function applyPais($query)
    {
        if (empty($this->paisSelected)) {
            return $query;
        }

        return $query->whereIn('pais_id', $this->paisSelected);
    }

    public function applyRol($query)
    {
        if (empty($this->rolSelected)) {
            return $query;
        }
        
        $roleIds = $this->rolSelected;

        return $query->whereHas('roles', function ($q) use ($roleIds) {
            $q->where('roles.id', $roleIds);
        });
    }

}
