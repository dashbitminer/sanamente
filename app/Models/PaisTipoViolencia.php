<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisTipoViolencia extends Model
{
    use HasFactory;

    protected $table = 'pais_tipo_violencias';

    protected $guarded = [];
}
