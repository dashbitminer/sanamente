<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisPerfilSeguimiento extends Model
{
    use HasFactory;

    protected $table = 'pais_perfil_seguimientos';

    protected $guarded = [];

    public function perfilSeguimiento()
    {
        return $this->belongsTo(PerfilSeguimiento::class, 'perfil_seguimiento_id');
    }

    public function seguimientoFormacionGenerales()
    {
        return $this->hasMany(SeguimientoFormacionGeneral::class, 'pais_perfil_seguimiento_id');
    }


}
