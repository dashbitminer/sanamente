<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referencia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'referencias';

    public function dateForHumans() {
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );
    }

    public function accionInmediata(): BelongsToMany
    {
        return $this->belongsToMany(PaisAccionInmediata::class, 'referencia_pais_accion_inmediatas', 'referencia_id', 'pais_accion_inmediata_id');
    }

    public function motivo(): BelongsToMany
    {
        return $this->belongsToMany(PaisMotivoReferencia::class, 'referencia_pais_motivos', 'referencia_id', 'pais_motivo_referencia_id');
    }

    public function tipoViolencia(): BelongsToMany
    {
        return $this->belongsToMany(PaisTipoViolencia::class, 'referencia_pais_tipo_violencia', 'referencia_id', 'pais_tipo_violencia_id');
    }

    public function tipoServicio(): BelongsToMany
    {
        return $this->belongsToMany(PaisTipoServicio::class, 'referencia_pais_tipo_servicios', 'referencia_id', 'pais_tipo_servicio_id');
    }

    public function paisInstitucionReferencia()
    {
        return $this->belongsTo(PaisInstitucionReferencia::class, 'pais_institucion_referencia_id');
    }

}
