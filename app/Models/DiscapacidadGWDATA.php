<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DiscapacidadGWDATA extends Model
{
    use HasFactory;

    // Specify the connection name for the model
    protected $connection = 'gwdata';

    // Define the table associated with the model
    protected $table = 'disability_beneficiaries_disabilities';

    public static function discapacidades()
    {
        return DB::connection("gwdata")
            ->table("disability_beneficiaries_disabilities")
            ->select('id', 'name')
            ->where('name', '<>', 'Ninguna')
            ->get();
    }
}
