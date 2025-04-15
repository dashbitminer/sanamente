<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class IntervencionParticipante extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    use SluggableScopeHelpers;
    use Userstamps;

    const NACIONAL = 1;

    const EXTRANJERO = 2;

    protected $table = 'intervencion_participantes';

    protected $fillable = [
        'nombres',
        'apellidos',
        'slug',
        'documento_identidad',
        'codigo_confirmacion',
        'nacionalidad',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'email',
        'active_at',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'full_name',
            ],
        ];
    }

    protected function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => "{$this->nombres} {$this->apellidos}",
        );
    }

    public function scopeActive($query)
    {
        return $query->whereNotNull('active_at');
    }

    public function getSexo(): string
    {
        return ($this->sexo == 1) ? "Mujer" : "Hombre";
    }

    public function getEdad(Pais $pais = null): string
    {
        $edad = Carbon::parse($this->fecha_nacimiento)->age;

        if ($edad > 1) {
            $edad .= ' años';
        } else if ($edad == 1) {
            $edad .= ' año';
        } else {
            // Calculo para recien nacidos
            $fecha_nacimiento = Carbon::parse($this->fecha_nacimiento);
            $current = Carbon::today($pais->timezone);

            $dias = $fecha_nacimiento->diffInDays($current);
            $dias = floor($dias);

            if ($dias < 31) {
                $edad = $dias . ($dias == 1 ? ' día' : ' dias');
            } else {
                $mes = floor($dias / 30);
                $edad = $mes . ($mes == 1 ? ' mes' : ' meses');
            }
        }

        return $edad;
    }

    public function intervenciones(): HasMany
    {
        return $this->hasMany(Intervencion::class, 'intervencion_participante_id');
    }
}
