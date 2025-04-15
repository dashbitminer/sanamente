<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipanteGWDATA extends Model
{
    use HasFactory;

    protected $connection = 'gwdata';

    protected $table = 'beneficiaries';

    protected $guarded = [];

    public function participanteEscuela()
    {
        return $this->hasMany(ParticipanteEscuelaGWDATA::class, 'fkIdBeneficiary', 'id');
    }

    public function discapacidades()
    {
        return $this->belongsToMany(DiscapacidadGWDATA::class, 'disability_beneficiaries', 'fkIdBeneficiary', 'disability_beneficiaries_disability_id')
                    ->withTimestamps();
    }
}
