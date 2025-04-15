<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApoyoPsicosocial extends Model
{
    use HasFactory;

    protected $table = 'apoyos_psicosociales';

    protected $fillable = [
        'persona_referida',
        'comentario',
        'active_at',
    ];
}
