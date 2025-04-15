<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisPerfilSeguimientoHospital extends Model
{
    use HasFactory;

    protected $table = 'pais_perfil_seguimiento_hospitales';

    protected $guarded = [];

    public function perfilSeguimientoHospital()
    {
        return $this->belongsTo(PerfilSeguimientoHospital::class, 'perfil_seguimiento_hospital_id');
    }
}
