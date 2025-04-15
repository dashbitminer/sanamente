<?php

namespace App\Livewire\BuscadorPersonas\Index;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Reactive;
use App\Models\ParticipanteGWDATA;
use Illuminate\Support\Facades\DB;

class Table extends Component
{
    use WithPagination, Searchable;

    public $perPage = 10;

    public $search = '';

    #[Reactive]
    public Filters $filters;

    public function render()
    {

        $query = ParticipanteGWDATA::leftJoin("group_beneficiary as gb", "gb.fkIdBeneficiary", "=", "beneficiaries.id")
            ->leftJoin("components_groups_school as cgs", "gb.fkIdGroupschool", "=", "cgs.id")
            ->leftJoin("sub_components as sbc", "cgs.fkIdSubcomponent", "=", "sbc.id")
            ->leftJoin("school_components as sc", "cgs.fkIdSchool", "=", "sc.fkIdSchool")
            ->leftJoin("schools as s", "sc.fkIdSchool", "=", "s.id")
            ->leftJoin("area_school as as", "s.code", "=", "as.fkCode")
            ->leftJoin("groups as gr", "cgs.fkIdGroup", "=", "gr.id")
            ->leftJoin('institutional_people as ip', 'beneficiaries.institutional_person_id', '=', 'ip.id')
            ->leftJoin('type_beneficiarios as tb', 'beneficiaries.fkIdTypeBeneficiarity', '=', 'tb.id')
            ->leftJoin("municipalities as m", "s.fkCodeMunicipality", "=", "m.codeMunicipality")
            ->leftJoin("states as st", "s.fkCodeState", "=", "st.codeState")
            ->leftJoin('components as c', "c.id", "=", "sc.fkIdComponent")
            ->leftJoin('school_beneficiaries as sb', 'sb.fkIdBeneficiary', '=', 'beneficiaries.id')
            ->leftJoin('schools as scs', 'scs.code', '=', 'sb.fkCode')
            ->where([
                ["sc.school_components_state_id", 1],
                ["s.school_state_id", 1],
                ["sbc.fkIdComponents", \App\Models\ComponenteGWDATA::PROGRAMA_SANAMENTE],
                ["as.fkIdArea", \App\Models\AreaGWDATA::AREA_SALUD],
                //["beneficiaries.id", 202748],
                //["beneficiaries.id", 195628],
                // ["c.id", \App\Models\ComponenteGWDATA::PROGRAMA_SANAMENTE],
                // ["a.id", \App\Models\AreaGWDATA::AREA_SALUD],
                // ["sbc.fkIdComponents", \App\Models\ComponenteGWDATA::PROGRAMA_SANAMENTE],
            ])
          //  ->whereIn("beneficiaries.id", [186370, 222091])
            ->select(
                "tb.name as tipo_beneficiario",
                "ip.name as perfil_institucional",
                "beneficiaries.id",
                "beneficiaries.fkIdTypeBeneficiarity",
                "beneficiaries.name as participante_name",
                "beneficiaries.surname as participante_lastname",
                "sc.id as school_component_id",
                "sc.fkIdSchool as school_id",
                "c.id as component_id",
                "c.name as component_name",
                "s.id as area_school_id",
                // "a.id as area_id",
                // "a.name as area_name",
                "s.id as schoolid",
                "scs.name as sede_procedencia",
                "s.code",
                "s.fkCodeCountry",
                "s.fkCodeState",
                "s.fkCodeMunicipality",
                "m.name as municipio",
                "st.name as departamento",
                "beneficiaries.genre_id as genero",
                "sbc.name as subcomponente",
                "sbc.id as subcomponente_id",
                "sbc.fkIdComponents as componente_id",
                "gr.name as grupo",
                "cgs.num_hour",
                "cgs.id as compgroupschoolid"
            )
            ->groupBy('beneficiaries.id');



        $query = $this->applySearch($query);

        //$query = $this->applySorting($query);

        $query = $this->filters->apply($query);

        $participantes = $query->paginate($this->perPage);

        $beneficiaryIds = $participantes->pluck('id')->toArray();

        $groupBeneficiaries = DB::connection("gwdata")->table("group_beneficiary as gb")
            ->leftJoin("components_groups_school as cgs", "gb.fkIdGroupschool", "=", "cgs.id")
            ->leftJoin("sub_components as sbc", "cgs.fkIdSubcomponent", "=", "sbc.id")
            ->leftJoin("schools as scs", "cgs.fkIdSchool", "=", "scs.id")
            ->whereIn("gb.fkIdBeneficiary", $beneficiaryIds)
            ->where("sbc.fkIdComponents", \App\Models\ComponenteGWDATA::PROGRAMA_SANAMENTE)
            ->leftJoin("groups as gr", "cgs.fkIdGroup", "=", "gr.id")
            ->select(
                "gb.fkIdBeneficiary",
                "gr.name as grupo",
                "horas",
                "cgs.num_hour",
                "cgs.id as compgroupschoolid",
                "fkIdSubcomponent",
                "fkIdGroupschool",
                "fkIdGroup",
                "sbc.name as subcomponente",
                "scs.name as escuela",
                "scs.id as escuelaid"
            )
            ->get()
            ->groupBy('fkIdBeneficiary');

           // dd($groupBeneficiaries);

        foreach ($participantes as $participante) {
            $participante->data = $groupBeneficiaries->get($participante->id, collect());


            $escuelas = $participante->data->pluck('escuela', 'escuelaid')->unique();

            if ($escuelas->count() > 1) {
                $participante->sede_base = $escuelas->values()->implode(', ');
            } else {
                $participante->sede_base = $escuelas->first();
            }


            foreach ($participante->data as $detalle) {

                $queryGroupSessions = \DB::connection("gwdata")->table('group_sessions')
                                ->leftJoin('group_sesion_details_benef as gsdb', 'group_sessions.id', '=', 'gsdb.fkGroupSession')
                                ->where('fkIdCompGroupSchool', $detalle->compgroupschoolid)
                                ->where('group_sessions_state_id', 1)
                                ->where('fkIdBeneficiary', $participante->id)
                                ->get();
//dd($queryGroupSessions);

                // $queryGroupSessions = \DB::connection("gwdata")->table('group_sessions')
                //     ->where('fkIdCompGroupSchool', $detalle->compgroupschoolid)
                //     ->where('group_sessions_state_id', 1)
                //     ->get();

                $lastSession = $queryGroupSessions->last();
                if ($lastSession) {
                    $detalle->last_group_session_created_at = $lastSession->date;
                }

                $detalle->group_sessions = $queryGroupSessions;

                $detalle->group_sessions_total_horas = $queryGroupSessions->sum("duration");

                // $sum_horas = 0;
                // foreach ($detalle->group_sessions as $group_session) {
                //     $group_session_details = \DB::connection("gwdata")->table('group_sesion_details_benef')
                //         ->where('fkGroupSession', $group_session->id)
                //         ->get();

                //     $group_session->total_horas = $group_session_details->sum('horas');

                //     $group_session->detalle = $group_session_details;

                //     $sum_horas += $group_session->total_horas;
                // }

               // $detalle->group_sessions_total_horas_detalle = $sum_horas;
            }
        }

        //dd($participantes[0]);

        return view('livewire.buscador-personas.index.table', [
            'participantes' => $participantes
        ]);
    }

    #[On('resetFilters')]
    public function resetFilters()
    {
        $this->perPage = 10;

        $this->search = '';
    }
}
