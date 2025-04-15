<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisPerfilSeguimientoSalud extends Model
{
    use HasFactory;

    protected $table = 'pais_perfil_seguimiento_salud';

    protected $guarded = [];

    public function perfilSeguimientoSalud()
    {
        return $this->belongsTo(PerfilSeguimientoSalud::class, 'perfil_seguimiento_salud_id');
    }
}
