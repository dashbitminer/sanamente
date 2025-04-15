<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaGWDATA extends Model
{
    use HasFactory;

    protected $connection = 'gwdata';

    protected $table = 'areas';

    const AREA_SALUD = 6;

}
