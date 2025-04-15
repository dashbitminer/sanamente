<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeccionGWDATA extends Model
{
    use HasFactory;

    // Specify the connection name for the model
    protected $connection = 'gwdata';

    protected $table = "section_schools";

    public function scopeActive($query)
    {
        return $query->whereNotNull('activo');
    }
}