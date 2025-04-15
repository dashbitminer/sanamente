<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formulario extends Model
{
    use HasFactory;
    use SluggableScopeHelpers;
    use SoftDeletes;
    use Userstamps;
    use Sluggable;

    protected $table = 'formularios';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'slug',
        'active_at',
        'codigo',
        'estructura',
        'pais_id',
        'tipo_formulario_id',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nombre',
            ],
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function scopeActive($query)
    {
        return $query->whereNotNull('active_at');
    }

    public function paises()
    {
        return $this->belongsToMany(Pais::class, 'formulario_pais', 'formulario_id', 'pais_id');
    }

}
