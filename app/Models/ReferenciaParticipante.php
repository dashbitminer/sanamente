<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenciaParticipante extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'referencia_participantes';

    protected $fillable = [
        'inicia_proceso_referencia', 'nombres', 'apellidos', 'fecha_nacimiento', 'sexo', 'nacionalidad',
        'telefono', 'documento_identidad', 'telefono_familiar', 'nombre_persona_responsable',
        'documento_identidad_persona_responsable', 'telefono_persona_responsable', 'pais_id',
        'ciudad_id', 'departamento_id', 'pais_perfil_participante_id', 'posee_discapacidad',
        'pais_tipo_discapacidad_id', 'pais_otra_condicion_id', 'otras_condiciones_otro'
    ];

    protected $dates = ['deleted_at'];

    public function dateForHumans() {
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );
    }

    public function fullName(){
        return $this->nombres . ' ' . $this->apellidos;
    }

    public function edad()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

    public function ultimaReferencia(){
        return [];
    }

    public function referencias()
    {
        return $this->hasMany(Referencia::class, 'referencia_participante_id');
    }
}
