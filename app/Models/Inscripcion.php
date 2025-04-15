<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscripcion extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    const NACIONAL = 1;

    const EXTRANJERO = 2;

    protected $table = 'inscripciones';

    protected $fillable = [
        'fecha_nacimiento',
        'institucion_organizacion_id',
        'nombres',
        'apellidos',
        'sexo',
        'pais_id',
        'departamento_id',
        'ciudad_id',
        'nacionalidad',
        'documento_identidad',
        'telefono',
        'email',
        'estudiando',
        'grado_id',
        'grado_seccion_id',
        'grado_jornada_id',
        'grado_alcanzado_id',
        'discapacidad',
        'discapacidad_id',
        'ha_participado_actividades_glasswing',
        'institutional_person_id_gwdata',
        'beneficiaries_subtype_id_gwdata',
        'perfil_identificas',
        'perfil_institucional_id',

        // Campos con solo una opcion
        'perfil_institucional_educacion_id',
        'perfil_rango_organizacion_id',

        // Campos policia con 2 opciones
        'perfil_institucional_policia_id',
        'perfil_rango_id',

        // Campo salud con 2 opciones
        'perfil_rango_salud_id',
        'perfil_personal_salud_id',

        'pertenece_departamento_id',
        'pertenece_ciudad_id',
        'pertenece_sede_id',
        'centro_educativo',
        'centro_educativo_tipo_id',
        'centro_educativo_cargo_id',
        'labora_departamento_id',
        'labora_municipio_id',
        'labora_aldea_id',
        'labora_caserio_id',
        'labora_codigo_sace',
        'centro_educativo_jornada',
        'centro_educativo_nivel_id',
        'centro_educativo_ciclo_id',
        'centro_educativo_zona_geografica',
        'autorizacion_informacion',
        'derechos_image_voz',
        'consentimiento',
        'codigo_confirmacion',
        'comentario',
        'user_id',
        'active_at',
        'imported_at',
        'imported_by',
    ];

    public function scopeActive($query)
    {
        return $query->whereNotNull('active_at');
    }

    public function dateForHumans() {
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );
    }

    public function getFullNameAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }


    public function grados(): BelongsTo
    {
        return $this->belongsTo(GradoGWDATA::class, 'grado_id', 'id');
    }

    public function secciones(): BelongsTo
    {
        return $this->belongsTo(SectionGWDATA::class, 'grado_seccion_id', 'id');
    }

    public function jornadas(): BelongsTo
    {
        return $this->belongsTo(JornadaGWDATA::class, 'grado_jornada_id', 'id');
    }

    public function ultimoGrados(): BelongsTo
    {
        return $this->belongsTo(UltimoGradoGWDATA::class, 'grado_alcanzado_id', 'id');
    }


    public function discapacidades(): HasMany
    {
        return $this->hasMany(InscripcionDiscapacidad::class, 'inscripcion_id');
    }


    public function institucionOrganizacion(): BelongsTo
    {
        return $this->belongsTo(InstitucionOrganizacion::class, 'institucion_organizacion_id');
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(DepartamentoGWDATA::class, 'departamento_id', 'codeState');
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(MunicipioGWDATA::class, 'ciudad_id', 'codeMunicipality');
    }

    public function perteneceDepartamento(): BelongsTo
    {
        return $this->belongsTo(DepartamentoGWDATA::class, 'pertenece_departamento_id', 'codeState');
    }

    public function perteneceMunicipio(): BelongsTo
    {
        return $this->belongsTo(MunicipioGWDATA::class, 'pertenece_ciudad_id', 'codeMunicipality');
    }

    public function perteneceSede(): BelongsTo
    {
        return $this->belongsTo(EscuelaGWDATA::class, 'pertenece_sede_id');
    }

    public function laboraDepartamento(): BelongsTo
    {
        return $this->belongsTo(DepartamentoGWDATA::class, 'labora_departamento_id', 'codeState');
    }

    public function laboraMunicipio(): BelongsTo
    {
        return $this->belongsTo(MunicipioGWDATA::class, 'labora_municipio_id', 'codeMunicipality');
    }

    public function tipoBeneficiatio(): BelongsTo
    {
        return $this->belongsTo(TipoBeneficiarioGWDATA::class, 'perfil_identificas');
    }


    public function personalInstitucional(): BelongsTo
    {
        return $this->belongsTo(PersonalInstitucionalGWDATA::class, 'perfil_institucional_id', 'id');
    }


    // Docentes de Educación
    public function beneficiarioSubtipoEducacion(): BelongsTo
    {
        return $this->belongsTo(BeneficiariesSubtypesGWDATA::class, 'perfil_institucional_educacion_id', 'id');
    }

    // Personal de organizaciones
    public function beneficiarioSubtipoOrganizaciones(): BelongsTo
    {
        return $this->belongsTo(SanamenteSubtiposGWDATA::class, 'perfil_rango_organizacion_id', 'id');
    }


    // Personal de la Policía
    public function sanamenteSubtiposPolicia(): BelongsTo
    {
        return $this->belongsTo(SanamenteSubtiposGWDATA::class, 'perfil_institucional_policia_id', 'id');
    }

    public function beneficiarioSubtipoPoliciaRango(): BelongsTo
    {
        return $this->belongsTo(BeneficiariesSubtypesGWDATA::class, 'perfil_rango_id', 'id');
    }


    // Personal de Salud
    public function sanamenteSubtiposSalud(): BelongsTo
    {
        return $this->belongsTo(SanamenteSubtiposGWDATA::class, 'perfil_rango_salud_id', 'id');
    }

    public function beneficiarioSubtipoSalud(): BelongsTo
    {
        return $this->belongsTo(BeneficiariesSubtypesGWDATA::class, 'perfil_personal_salud_id', 'id');
    }

    public function centroEducativoTipos(): BelongsTo
    {
        return $this->belongsTo(CentroEducativoTipo::class, 'centro_educativo_tipo_id');
    }

    public function centroEducativoCargos(): BelongsTo
    {
        return $this->belongsTo(CentroEducativoCargo::class, 'centro_educativo_cargo_id');
    }

    public function centroEducativoNiveles(): BelongsTo
    {
        return $this->belongsTo(CentroEducativoNivel::class, 'centro_educativo_nivel_id');
    }

    public function centroEducativoCiclos(): BelongsTo
    {
        return $this->belongsTo(CentroEducativoCiclo::class, 'centro_educativo_ciclo_id');
    }

    public function getFormattedNombresToUpperCaseAttribute() {
        //$normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $normalized = transliterator_transliterate("Any-Latin; Latin-ASCII", $this->nombres);
        return strtoupper($normalized);
    }

    public function getFormattedApellidosToUpperCaseAttribute() {
        //$normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $normalized = transliterator_transliterate("Any-Latin; Latin-ASCII", $this->apellidos);
        return strtoupper($normalized);
    }

}
