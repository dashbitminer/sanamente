<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ReferenciaIntervencion extends Model
{
    use HasFactory;

    protected $table = 'referencia_intervenciones';

    protected $fillable = [
        'conceptualizacion_problema',
        'razon_intervencion_id',
        'razon_otro',
        'proceso_otro',
        'referencia',
        'comentario',
        'active_at',
    ];

    public function razonIntervencion(): BelongsTo
    {
        return $this->belongsTo(RazonIntervencion::class, 'razon_intervencion_id');
    }

    public function referenciasProcesos(): BelongsToMany
    {
        return $this->belongsToMany(
            Proceso::class,
            'referencias_intervencion_procesos',
            'referencia_intervencion_id',
            'proceso_id'
        );
    }

    public function intervencionImages(): MorphMany
    {
        return $this->morphMany(IntervencionImage::class, 'imageable');
    }
}
