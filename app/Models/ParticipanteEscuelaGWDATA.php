<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipanteEscuelaGWDATA extends Model
{
    use HasFactory;

    protected $connection = 'gwdata';

    protected $table = 'school_beneficiaries';

    protected $guarded = [];


}
