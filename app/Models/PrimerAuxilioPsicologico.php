<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimerAuxilioPsicologico extends Model
{
    use HasFactory;

    protected $table = 'primeros_auxilios_psicologicos';

    protected $fillable = [
        'consentimiento',
        'comentario',
        'active_at',
    ];
}
