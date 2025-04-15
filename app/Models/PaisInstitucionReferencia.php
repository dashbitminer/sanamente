<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisInstitucionReferencia extends Model
{
    use HasFactory;

    protected $table = 'pais_institucion_referencias';

    protected $guarded = [];

    public function institucionReferencia()
{
    return $this->belongsTo(InstitucionReferencia::class, 'institucion_referencia_id');
}
}
