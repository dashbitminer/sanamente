<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class IntervencionImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'intervencion_images';

    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type',
        'active_at',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
