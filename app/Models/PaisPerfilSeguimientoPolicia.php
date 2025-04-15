<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisPerfilSeguimientoPolicia extends Model
{
    use HasFactory;

    protected $table = 'pais_perfil_seguimiento_policias';

    protected $guarded = [];

    public function perfilSeguimientoPolicia()
    {
        return $this->belongsTo(PerfilSeguimientoPolicia::class, 'perfil_seguimiento_policia_id');
    }
}
