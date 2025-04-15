<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipioGWDATA extends Model
{
    use HasFactory;

    protected $connection = 'gwdata';

    protected $table = 'municipalities';
}
