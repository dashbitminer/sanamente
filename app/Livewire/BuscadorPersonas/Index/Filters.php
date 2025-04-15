<?php

namespace App\Livewire\BuscadorPersonas\Index;

use Livewire\Form;
use App\Models\Estado;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use App\Livewire\FGSM\Index\Range;
use App\Models\EstadoRegistro;
use App\Models\EstadoRegistroParticipante;

class Filters extends Form
{
    public $estados;

    public $status = 0;

    public $updatepage = false;

    public $paisSelected;

    public $departamentoSelected;

    public $municipioSelected;

    public $escuelaSelected = [];

    public $perfilSelected;

    public $subcomponenteSelected = [];

    public $tipoPersonaSelected;

    public $subtipoSelected = [];

    public $gruposSelected = [];

    #[Url]
    public Range $range = Range::All_Time;

    #[Url]
    public $start;

    #[Url]
    public $end;

    #[Url(as: 'estados')]
    public $selectedEstadosIds = [];

    public function initRange()
    {
        if ($this->range !== Range::Custom) {
            $this->start = null;
            $this->end = null;
        }
    }


    public function resetFilters()
    {
        $this->paisSelected = null;

        $this->departamentoSelected = null;

        $this->municipioSelected = null;

        $this->escuelaSelected = [];

        $this->perfilSelected = null;

        $this->subcomponenteSelected = [];

        $this->tipoPersonaSelected = null;

        $this->subtipoSelected = [];

        $this->gruposSelected = [];
    }


    public function apply($query)
    {
     // $query = $this->applyRange($query);

      //$query = $this->applyDepartamentoFilter($query);

      $query = $this->applyCountryFilter($query);

      $query = $this->applyDepartamentoFilter($query);

      $query = $this->applyMunicipioFilter($query);

      $query = $this->applySedeFilter($query);

      $query = $this->applySubcomponenteFilter($query);

      $query = $this->applyTipoPersonaFilter($query);

      $query = $this->applySubtipoFilter($query);

      $query = $this->applyGruposFilter($query);


       return $query;
    }


    public function applyCountryFilter($query)
    {
        if ($this->paisSelected) {
            $query->where('beneficiaries.fkCodeCountry', $this->paisSelected);
        }

        return $query;
    }


    public function applyDepartamentoFilter($query)
    {
        if ($this->departamentoSelected) {
            $query->where('beneficiaries.fkCodeState', $this->departamentoSelected);
        }

        return $query;
    }

    public function applyMunicipioFilter($query)
    {
        if ($this->municipioSelected) {
            $query->where('beneficiaries.fkCodeMunicipality', $this->municipioSelected);
        }

        return $query;
    }

    public function applySedeFilter($query)
    {
        if ($this->escuelaSelected) {
            $query->whereIn('scs.id', $this->escuelaSelected);
        }

        return $query;
    }

    public function applySubcomponenteFilter($query)
    {
        if ($this->subcomponenteSelected) {
            $query->whereIn('sbc.id', $this->subcomponenteSelected);
        }

        return $query;
    }

    public function applyTipoPersonaFilter($query)
    {
        if ($this->tipoPersonaSelected) {
            $query->where('beneficiaries.fkIdTypeBeneficiarity', $this->tipoPersonaSelected);
        }

        return $query;
    }

    public function applySubtipoFilter($query)
    {
        if ($this->subtipoSelected) {
            $query->whereIn('beneficiaries.institutional_person_id', $this->subtipoSelected);
        }

        return $query;
    }

    public function applyGruposFilter($query)
    {
        if ($this->gruposSelected) {
            $query->whereIn('gr.id', $this->gruposSelected);
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

            return $query->whereBetween('created_at', [$start, $end]);
        }

        return $query->whereBetween('created_at', $this->range->dates());
    }






}
