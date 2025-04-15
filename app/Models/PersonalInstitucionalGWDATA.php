<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PersonalInstitucionalGWDATA extends Model
{
    use HasFactory;

    // Specify the connection name for the model
    protected $connection = 'gwdata';

    // Define the table associated with the model
    protected $table = 'institutional_people';

    public static function getPerfilInstitucional()
    {
        return DB::connection("gwdata")
            ->table("institutional_people")
            ->select('id', 'name')
            ->where('active_at', '<>', null)
            ->orderBy('name')
            ->get();
    }

    // public static function getSanamenteSubtipos($id_institucional)
    // {
    //     return DB::connection("gwdata")
    //         ->table("sanamente_subtipos")
    //         ->select('id', 'name', 'id_beneficiaries_sub')
    //         ->where('active', 1)
    //         ->where('id_institucional', $id_institucional)
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }

    // public static function getSubTipos($institutional_person_id)
    // {
    //     return DB::connection("gwdata")
    //         ->table("beneficiaries_subtypes")
    //         ->select('id', 'name')
    //         ->where('active_at', '<>', null)
    //         ->where('institutional_person_id', $institutional_person_id)
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }
}
