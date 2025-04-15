<?php

namespace App\Livewire\BuscadorPersonas\Traits;

use App\Models\Pais;
use App\Models\EscuelaGWDATA;
use App\Models\ComponenteGWDATA;
use Illuminate\Support\Facades\DB;

trait BuscadorTrait
{


    public function initializeVariables()
    {

        $queryPais = Pais::query();

        if (!auth()->user()->can('Acceso total')) {
            $queryPais->where('codigo', $this->codigoUsuarioPais);
        }

        $paises = $queryPais->get();


        $this->subtipos = \App\Models\PersonalInstitucionalGWDATA::getPerfilInstitucional();

        return [
            'paises' => $paises,
            'grupos' => DB::connection("gwdata")->table("groups")->select('id','name')
                        ->get(),
            'tipoPersonas' => DB::connection("gwdata")->table("type_beneficiarios")->select('id','name')
                        ->whereNotNull('active_at')
                        ->where('typePerson', 1)
                        ->get(),
            'subtipos' => $this->subtipos,
            'subcomponentes' => DB::connection("gwdata")->table("sub_components")->select('id','name','requiredVoluntary')
                                ->where('fkIdComponents',ComponenteGWDATA::PROGRAMA_SANAMENTE)
                                ->get()
        ];
    }



    public function search($query, $model, $columns = ['*'])
    {
        return $model::where(function ($q) use ($query, $columns) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', "%{$query}%");
            }
        })->get();
    }
}
