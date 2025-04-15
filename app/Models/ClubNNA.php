<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class ClubNNA extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $table = 'club_nnas';

    protected $guarded = [];

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

    public function parentescoGWDATA()
    {
        return $this->belongsTo(ParentescoGWDATA::class, 'parentesco_gwdata_id');
    }

    public function escuelaGWDATA()
    {
        return $this->belongsTo(EscuelaGWDATA::class, 'escuela_gwdata_id');
    }

    public function seccionGWDATA()
    {
        return $this->belongsTo(SeccionGWDATA::class, 'seccion_gwdata_id');
    }

    public function turnoGWDATA()
    {
        return $this->belongsTo(TurnoGWDATA::class, 'turno_gwdata_id');
    }

    public function ultimoGradoGWDATA()
    {
        return $this->belongsTo(UltimoGradoGWDATA::class, 'ultimo_grado_alcanzado_gwdata_id');
    }

    public function nivelAcademicoGWDATA()
    {
        return $this->belongsTo(NivelAcademicoGWDATA::class, 'grado_gwdata_id');
    }

    public function departamentoReside()
    {
        return $this->belongsTo(DepartamentoGWDATA::class, 'departamento_reside_gwdata_code_state', 'codeState');
    }

    public function municipioReside()
    {
        return $this->belongsTo(MunicipioGWDATA::class, 'municipio_reside_gwdata_code_municipality', 'codeMunicipality');
    }

    public function edad()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
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
