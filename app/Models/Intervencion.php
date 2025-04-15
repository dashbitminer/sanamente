<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intervencion extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = 'intervenciones';

    protected $fillable = [
        'intervencion_participante_id',
        'tipo_intervencion',
        'cantidad_hombres',
        'cantidad_mujeres',
        'primera_intervencion',
        'compartir_informacion',
        'pais_id',
        'departamento_id',
        'ciudad_id',
        'sede_id',
        'perfil_participante_id',
        'perfil_participante',
        'fecha_intervencion',
        'inicio_intervencion',
        'fin_intervencion',
        'pauso_intervencion',
        'total_intervencion',
        'persona_referida',
        'protocolo_sanamente_id',
        'primer_auxilio_psicologico_id',
        'referencia_intervencion_id',
        'discapacidad',
        'discapacidad_id',
        'participar_proceso_evaluacion',
        'codigo_confirmacion',
        'comentario',
        'comentario_apoyo_psicosocial',
        'user_id',
        'active_at',
        'created_at',
        'updated_at',
    ];

    public function dateForHumans() {
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );
    }

    public function intervencionParticipante(): BelongsTo
    {
        return $this->belongsTo(IntervencionParticipante::class, 'intervencion_participante_id');
    }

    public function tipoIntervencion(): BelongsToMany
    {
        return $this->belongsToMany(
            TipoIntervencion::class,
            'intervencion_tipo_intervenciones',
            'intervencion_id',
            'tipo_intervencion_id'
        );
    }

    public function tipoOtraIntervencion(): BelongsToMany
    {
        return $this->belongsToMany(
            TipoOtraIntervencion::class,
            'intervencion_tipo_otra_intervencion',
            'intervencion_id',
            'tipo_otra_intervencion_id'
        );
    }

    public function sede(): BelongsTo
    {
        return $this->belongsTo(EscuelaGWDATA::class, 'sede_id');
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(DepartamentoGWDATA::class, 'departamento_id', 'codeState');
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(MunicipioGWDATA::class, 'ciudad_id', 'codeMunicipality');
    }

    public function protocoloSanamente(): BelongsTo
    {
        return $this->belongsTo(ProtocoloSanamente::class, 'protocolo_sanamente_id');
    }

    public function primerAuxilioPsicologico(): BelongsTo
    {
        return $this->belongsTo(PrimerAuxilioPsicologico::class, 'primer_auxilio_psicologico_id');
    }

    public function referenciaIntervencion(): BelongsTo
    {
        return $this->belongsTo(ReferenciaIntervencion::class, 'referencia_intervencion_id');
    }

    public function perfilParticipante(): BelongsTo
    {
        return $this->belongsTo(PerfilParticipante::class, 'perfil_participante_id');
    }

    public function frecuencia(): int
    {
        return Intervencion::where('intervencion_participante_id', $this->intervencion_participante_id)->count();
    }
}
