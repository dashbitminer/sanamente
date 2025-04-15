<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GradoGWDATA extends Model
{
    use HasFactory;

    public const TECNICO = 'Estudios técnicos';

    public const UNIVERSITARIOS = 'Estudios universitarios';

    public const MASTER = 'Estudios de master y PhD';

    // Specify the connection name for the model
    protected $connection = 'gwdata';

    // Define the table associated with the model
    protected $table = 'levels';
}
