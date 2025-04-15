<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenciaSeguimiento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'referencia_seguimientos';

    protected $fillable = [
        'referencia_id',
        'ha_recibido_servicio',
        'descripcion',
        'pais_seguimiento_detalle_id',
        'pais_seguimiento_paso_id',
        'solicita_otra_referencia',
        'comentario',
        'active_at',
    ];

    public function dateForHumans() {
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );
    }
}
