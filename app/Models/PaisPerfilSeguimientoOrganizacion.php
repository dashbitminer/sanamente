<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisPerfilSeguimientoOrganizacion extends Model
{
    use HasFactory;

    protected $table = 'pais_perfil_seguimiento_organizaciones';

    protected $guarded = [];

    public function perfilSeguimientoOrganizacion()
    {
        return $this->belongsTo(PerfilSeguimientoOrganizacion::class, 'perfil_seguimiento_organizacion_id');
    }
}
