<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisActividadSeguimiento extends Model
{
    use HasFactory;

    protected $table = 'pais_actividad_seguimientos';

    protected $guarded = [];

    public function actividadSeguimiento()
    {
        return $this->belongsTo(ActividadSeguimiento::class, 'actividad_seguimiento_id');
    }
}
