<?php

namespace App\Models;

use Carbon\Carbon;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SeguimientoFormacionGeneral extends Model
{
    use HasFactory;
    use SluggableScopeHelpers;
    use SoftDeletes;
    use Userstamps;
    use Sluggable;

    const NACIONAL = 1;
    const EXTRANJERO = 2;


    protected $table = 'seguimiento_formacion_generales';

    protected $guarded = [];

    // protected $fillable = [
    //     'pais_id',
    //     'nombres',
    //     'apellidos',
    //     'nacionalidad',
    //     'participacion',
    //     'slug',
    //     'documento_identidad',
    //     'pais_perfil_seguimiento_id',
    //     'pais_perfil_seguimiento_docente_id',
    //     'pais_perfil_seguimiento_policia_id',
    //     'pais_rango_seguimiento_policia_id',
    //     'pais_perfil_seguimiento_salud_id',
    //     'escuela_id',
    //     'ciudad_id',
    //     'departamento_id',
    //     'numero_grupo_participa',
    //     'comentario',
    //     'active_at',
    //     'codigo_confirmacion',
    //     'fecha_participo_actividad',
    //     'formulario_id',
    // ];

    protected $casts = [
        'active_at' => 'datetime',
        'fecha_participo_actividad' => 'date'
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
                'source' => 'full_name',
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

     /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => "{$this->nombres} {$this->apellidos}",
            //  set: fn ($value) =>  Carbon::parse($value)->format('Y-m-d'),
        );
    }


    /**
     * The roles that belong to the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function paisActividades(): BelongsToMany
    {
        return $this->belongsToMany(PaisActividadSeguimiento::class, 'formacion_pais_actividad', 'seguimiento_formacion_general_id', 'pais_actividad_seguimiento_id')->withTimestamps();
    }


    public function getSexo(): string
    {
        return ($this->sexo == 1) ? "Mujer" : "Hombre";
    }





    public function dateForHumans() {

        //$fecha = Carbon::createFromFormat( 'Y-m-d H:i:s',$this->created_at ,'UTC');

        // $fecha->setTimezone('America/Guatemala');

        //return Carbon::parse( $fecha ,'America/Guatemala')->format( 'M d, Y, g:i A' );
        //return Carbon::parse( $fecha ,'America/Guatemala')->format( 'M d, Y, g:i A' );
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );

    }

    /**
     * Get the paisPerfilSeguimiento that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paisPerfilSeguimiento(): BelongsTo
    {
        return $this->belongsTo(PaisPerfilSeguimiento::class, 'pais_perfil_seguimiento_id');
    }

    /**
     * Get the paisPerfilSeguimientoDocente that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paisPerfilSeguimientoDocente(): BelongsTo
    {
        return $this->belongsTo(PaisPerfilSeguimientoDocente::class, 'pais_perfil_seguimiento_docente_id');
    }

    /**
     * Get the paisPerfilSeguimientoPolicia that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paisPerfilSeguimientoPolicia(): BelongsTo
    {
        return $this->belongsTo(PaisPerfilSeguimientoPolicia::class, 'pais_perfil_seguimiento_policia_id');
    }

    /**
     * Get the paisRangoSeguimientoPolicia that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paisRangoSeguimientoPolicia(): BelongsTo
    {
        return $this->belongsTo(PaisRangoSeguimientoPolicia::class, 'pais_rango_seguimiento_policia_id');
    }

    /**
     * Get the paisPerfilSeguimientoSalud that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paisPerfilSeguimientoSalud(): BelongsTo
    {
        return $this->belongsTo(PaisPerfilSeguimientoSalud::class, 'pais_perfil_seguimiento_salud_id');
    }


    /**
     * Get the paisPerfilSeguimientoOrganizacion that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paisPerfilSeguimientoOrganizacion(): BelongsTo
    {
        return $this->belongsTo(PaisPerfilSeguimientoOrganizacion::class, 'pais_perfil_seguimiento_organizacion_id');
    }

    /**
     * Get the paisPerfilSeguimientoHospital that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paisPerfilSeguimientoHospital(): BelongsTo
    {
        return $this->belongsTo(PaisPerfilSeguimientoHospital::class, 'pais_perfil_seguimiento_hospital_id');
    }




    /**
     * Get the escuela that owns the SeguimientoFormacionGeneral
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function escuela(): BelongsTo
    {
        return $this->belongsTo(EscuelaGWDATA::class, 'escuela_id');
    }


}
