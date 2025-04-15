<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ProtocoloSanamente extends Model
{
    use HasFactory;

    protected $table = 'protocolo_sanamentes';

    protected $fillable = [
        'pauso_protocolo',
        'pauso_protocolo_id',
        'pauso_protocolo_otros',
        'consentimiento',
        'comentario',
        'active_at',
    ];

    public function tipoPsicoeducacion(): BelongsToMany
    {
        return $this->belongsToMany(
            TipoPsicoeducacion::class,
            'sanamente_tipo_psicoeducaciones',
            'protocolo_sanamente_id',
            'tipo_psicoeducacion_id'
        );
    }

    public function estrategia(): BelongsToMany
    {
        return $this->belongsToMany(
            Estrategia::class,
            'sanamente_estrategias',
            'protocolo_sanamente_id',
            'estrategia_id'
        );
    }

    public function intervencionImages(): MorphMany
    {
        return $this->morphMany(IntervencionImage::class, 'imageable');
    }

    public function pausoProtocolo(): BelongsTo
    {
        return $this->belongsTo(PausoProtocolo::class, 'pauso_protocolo_id');
    }
}
