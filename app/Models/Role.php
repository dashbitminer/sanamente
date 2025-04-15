<?php

namespace App\Models;

use Carbon\Carbon;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends SpatieRole
{
    use HasFactory;
    use Userstamps;
    use HasPermissions;

    public $guarded = [];


    public function dateForHumans() {
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );
    }
}
