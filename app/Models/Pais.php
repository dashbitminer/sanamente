<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pais extends Model
{
    use HasFactory;
    use SluggableScopeHelpers;
    use SoftDeletes;
    use Userstamps;
    use Sluggable;

    protected $table = 'paises';

    const MEXICO = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'timezone',
        'slug',
        'active_at',
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
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function scopeActive($query)
    {
        return $query->whereNotNull('active_at');
    }

    /**
     * Get all of the comments for the Pais
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departamentos(): HasMany
    {
        return $this->hasMany(Departamento::class, 'pais_id');
    }

    public function perfilesSeguimiento(): BelongsToMany
    {
        return $this->belongsToMany(PerfilSeguimiento::class, 'pais_perfil_seguimientos', 'pais_id', 'perfil_seguimiento_id');
    }

    public function perfilesSeguimientoDocente(): BelongsToMany
    {
        return $this->belongsToMany(PerfilSeguimientoDocente::class, 'pais_perfil_seguimiento_docentes', 'pais_id', 'perfil_seguimiento_docente_id');
    }

    public function perfilesSeguimientoPolicia(): BelongsToMany
    {
        return $this->belongsToMany(PerfilSeguimientoPolicia::class, 'pais_perfil_seguimiento_policias', 'pais_id', 'perfil_seguimiento_policia_id');
    }

    public function rangoPerfilesSeguimientoPolicia(): BelongsToMany
    {
        return $this->belongsToMany(RangoSeguimientoPolicia::class, 'pais_rango_seguimiento_policias', 'pais_id', 'rango_seguimiento_policia_id');
    }

    public function perfilesSeguimientoOrganizacion(): BelongsToMany
    {
        return $this->belongsToMany(PerfilSeguimientoOrganizacion::class, 'pais_perfil_seguimiento_organizaciones', 'pais_id', 'perfil_seguimiento_organizacion_id');
    }

    public function perfilesSeguimientoSalud(): BelongsToMany
    {
        return $this->belongsToMany(PerfilSeguimientoSalud::class, 'pais_perfil_seguimiento_salud', 'pais_id', 'perfil_seguimiento_salud_id');
    }

    public function perfilesSeguimientoHospital(): BelongsToMany
    {
        return $this->belongsToMany(PerfilSeguimientoHospital::class, 'pais_perfil_seguimiento_hospitales', 'pais_id', 'perfil_seguimiento_hospital_id');
    }

    public function actividadesSeguimiento(): BelongsToMany
    {
        return $this->belongsToMany(ActividadSeguimiento::class, 'pais_actividad_seguimientos', 'pais_id', 'actividad_seguimiento_id');
    }

    public function perfilParticipante(): BelongsToMany
    {
        return $this->belongsToMany(PerfilParticipante::class, 'pais_perfil_participantes', 'pais_id', 'perfil_participante_id');
    }

    public function tipoIntervencion(): BelongsToMany
    {
        return $this->belongsToMany(TipoIntervencion::class, 'pais_tipo_intervenciones', 'pais_id', 'tipo_intervencion_id');
    }

    public function tipoOtraIntervencion(): BelongsToMany
    {
        return $this->belongsToMany(TipoOtraIntervencion::class, 'pais_tipo_otras_intervenciones', 'pais_id', 'tipo_otra_intervencion_id');
    }

    public function canceloProtocolo(): BelongsToMany
    {
        return $this->belongsToMany(CanceloProtocolo::class, 'pais_cancelo_protocolos', 'pais_id', 'cancelo_protocolo_id');
    }

    public function tipoPsicoeducacion(): BelongsToMany
    {
        return $this->belongsToMany(TipoPsicoeducacion::class, 'pais_tipo_psicoeducaciones', 'pais_id', 'tipo_psicoeducacion_id');
    }

    public function estrategias(): BelongsToMany
    {
        return $this->belongsToMany(Estrategia::class, 'pais_estrategias', 'pais_id', 'estrategia_id');
    }

    public function pausoProtocolo(): BelongsToMany
    {
        return $this->belongsToMany(PausoProtocolo::class, 'pais_pauso_protocolos', 'pais_id', 'pauso_protocolo_id');
    }

    public function razonIntervencion(): BelongsToMany
    {
        return $this->belongsToMany(RazonIntervencion::class, 'pais_razon_intervenciones', 'pais_id', 'razon_intervencion_id');
    }

    public function procesos(): BelongsToMany
    {
        return $this->belongsToMany(Proceso::class, 'pais_procesos', 'pais_id', 'proceso_id');
    }

    public function tipoDiscapacidad(): BelongsToMany
    {
        return $this->belongsToMany(TipoDiscapacidad::class, 'pais_tipo_discapacidades', 'pais_id', 'tipo_discapacidad_id');
    }

    public function otraCondicion(): BelongsToMany
    {
        return $this->belongsToMany(OtraCondicion::class, 'pais_otra_condiciones', 'pais_id', 'otra_condicion_id');
    }

    public function accionInmediata(): BelongsToMany
    {
        return $this->belongsToMany(AccionInmediata::class, 'pais_accion_inmediatas', 'pais_id', 'accion_inmediata_id');
    }

    public function motivoReferencia(): BelongsToMany
    {
        return $this->belongsToMany(MotivoReferencia::class, 'pais_motivo_referencias', 'pais_id', 'motivo_referencia_id');
    }
    public function tipoViolencia(): BelongsToMany
    {
        return $this->belongsToMany(TipoViolencia::class, 'pais_tipo_violencias', 'pais_id', 'tipo_violencia_id');
    }

    public function tipoServicio(): BelongsToMany
    {
        return $this->belongsToMany(TipoServicio::class, 'pais_tipo_servicios', 'pais_id', 'tipo_servicio_id');
    }

    public function saludMentalServicio(): BelongsToMany
    {
        return $this->belongsToMany(SaludMentalServicio::class, 'pais_salud_mental_servicios', 'pais_id', 'salud_mental_servicio_id');
    }

    public function institucionReferencia(): BelongsToMany
    {
        return $this->belongsToMany(InstitucionReferencia::class, 'pais_institucion_referencias', 'pais_id', 'institucion_referencia_id');
    }

    public function urgenciaReferenciaParametro(): BelongsToMany
    {
        return $this->belongsToMany(UrgenciaReferenciaParametro::class, 'pais_urgencia_referencia_parametros', 'pais_id', 'urgencia_referencia_parametro_id');
    }

    public function modalidadConsentimiento(): BelongsToMany
    {
        return $this->belongsToMany(ModalidadConsentimiento::class, 'pais_modalidad_consentimientos', 'pais_id', 'modalidad_consentimiento_id');
    }

    public function origenReferencia(): BelongsToMany
    {
        return $this->belongsToMany(OrigenReferencia::class, 'pais_origen_referencias', 'pais_id', 'origen_referencia_id');
    }

    public function noAceptaReferenciaRazon(): BelongsToMany
    {
        return $this->belongsToMany(NoAceptaReferenciaRazon::class, 'pais_no_acepta_referencia_razones', 'pais_id', 'no_acepta_referencia_razon_id');
    }

    public function seguimientoDetalle(): BelongsToMany
    {
        return $this->belongsToMany(SeguimientoDetalle::class, 'pais_seguimiento_detalles', 'pais_id', 'seguimiento_detalle_id');
    }

    public function seguimientoPaso(): BelongsToMany
    {
        return $this->belongsToMany(SeguimientoPaso::class, 'pais_seguimiento_pasos', 'pais_id', 'seguimiento_paso_id');
    }

    public function intervencionistas(): HasMany
    {
        return $this->hasMany(Intervencionista::class, 'pais_id');
    }
}
