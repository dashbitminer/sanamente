<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Wildside\Userstamps\Userstamps;

class MotivoReferencia extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    use SluggableScopeHelpers;
    use Userstamps;

    protected $table = 'motivo_referencias';

    protected $fillable = [
        'nombre',
        'slug',
        'active_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombre',
            ],
        ];
    }

    public function paises(): BelongsToMany
    {
        return $this->belongsToMany(Pais::class, 'pais_motivo_referencias', 'motivo_referencia_id', 'pais_id');
    }
}
