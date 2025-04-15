<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class InscripcionDiscapacidad extends Model
{
    use HasFactory;
    use Userstamps;

    protected $table = 'inscripcion_discapacidades';

    protected $fillable = [
        'inscripcion_id',
        'discapacidad_id',
    ];

    public function discapacidad(): BelongsTo
    {
        return $this->belongsTo(DiscapacidadGWDATA::class, 'discapacidad_id', 'id');
    }
}
