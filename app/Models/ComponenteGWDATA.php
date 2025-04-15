<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponenteGWDATA extends Model
{
    use HasFactory;

    protected $connection = 'gwdata';

    protected $table = 'components';

    const PROGRAMA_SANAMENTE = 31;

    const NNA = 54;

    // $school_components = DB::table('components as c')
    // ->join('school_components as sc' ,'c.id','=','sc.fkIdComponent')
    // ->select('sc.id as id','sc.fkIdSchool as ids','c.id as fkIdClub','c.name as name','sc.school_components_state_id as state')
    // ->where([['sc.fkIdSchool',$fkIdSchool],['sc.school_components_state_id',1]])
    // ->get();

    // $AreasIntervencion = DB::table('area_school as s')
    // ->join('areas as a', 's.fkIdArea', '=', 'a.id')
    // ->select('s.id as ida','a.id as id','a.name as name','s.year as year','s.state as state','s.observations as obs')->where([
    //   ['s.fkCode',$school[0]->code],
    // ])->orderBy('a.id','asc')->get();


}
