<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NivelAcademicoGWDATA extends Model
{
    use HasFactory;

    // Specify the connection name for the model
    protected $connection = 'gwdata';

    protected $table = "levels";
}
