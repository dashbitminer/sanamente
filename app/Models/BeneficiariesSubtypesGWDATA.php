<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BeneficiariesSubtypesGWDATA extends Model
{
    use HasFactory;

    // Specify the connection name for the model
    protected $connection = 'gwdata';

    // Define the table associated with the model
    protected $table = 'beneficiaries_subtypes';
}
