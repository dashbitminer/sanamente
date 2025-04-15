<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    use HasUuids;
    use HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'uuid',
        'email',
        'pais_id',
        'password',
    ];



    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->uuid = (string) \Illuminate\Support\Str::uuid();
    //     });
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Generate a new UUID for the model.
     */
    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }


    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function dateForHumans() {

        //$fecha = Carbon::createFromFormat( 'Y-m-d H:i:s',$this->created_at ,'UTC');

        // $fecha->setTimezone('America/Guatemala');

        //return Carbon::parse( $fecha ,'America/Guatemala')->format( 'M d, Y, g:i A' );
        //return Carbon::parse( $fecha ,'America/Guatemala')->format( 'M d, Y, g:i A' );
        return Carbon::parse( $this->created_at)->format( 'M d, Y, g:i A' );

    }

    public function activate()
    {
        $this->active_at = now();
        $this->save();
    }

    public function deactivate()
    {
        $this->active_at = null;
        $this->save();
    }

    public function isActive()
    {
        return !is_null($this->active_at);
    }

}
