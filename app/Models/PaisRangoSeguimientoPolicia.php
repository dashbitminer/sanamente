<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisRangoSeguimientoPolicia extends Model
{
    use HasFactory;

    protected $table = 'pais_rango_seguimiento_policias';

    protected $guarded = [];

    public function rangoSeguimientoPolicias()
    {
        return $this->belongsTo(RangoSeguimientoPolicia::class, 'rango_seguimiento_policia_id');
    }
}
