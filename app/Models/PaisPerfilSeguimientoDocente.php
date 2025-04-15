<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisPerfilSeguimientoDocente extends Model
{
    use HasFactory;

    protected $table = 'pais_perfil_seguimiento_docentes';

    protected $guarded = [];

    public function perfilSeguimientoDocente()
    {
        return $this->belongsTo(PerfilSeguimientoDocente::class, 'perfil_seguimiento_docente_id');
    }
}
