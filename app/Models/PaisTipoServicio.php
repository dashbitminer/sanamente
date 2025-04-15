<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisTipoServicio extends Model
{
    use HasFactory;

    protected $table = 'pais_tipo_servicios';

    protected $guarded = [];
}
