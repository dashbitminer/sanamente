<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ParentescoGWDATA extends Model
{
    use HasFactory;

    // Specify the connection name for the model
    protected $connection = 'gwdata';

    // Define the table associated with the model
    protected $table = 'family_relationships';

    public static function parentescos()
    {
        return DB::connection("gwdata")
            ->table("family_relationships")
            ->select('id', 'name')
            ->get();
    }
}
