<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoBeneficiarioGWDATA extends Model
{
    use HasFactory;

    protected $connection = 'gwdata';

    protected $table = 'type_beneficiarios';
}
