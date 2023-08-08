<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function hasRole($role)
    {
        return $this->role === $role;
    }




    // Definir la relación entre User y Cliente
    public function client()
    {
        return $this->hasOne(Client::class, 'communitys_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    public function coordinators()
    {
        return $this->belongsToMany(User::class, 'user_coordinator', 'user_id', 'coordinator_id');
    }

    public function coordinatorss()
    {
        return $this->belongsToMany(User::class, 'user_coordinator', 'user_id', 'coordinator_id')
            ->withPivot('id');
    }

    public function communities()
    {
        return $this->belongsToMany(User::class, 'user_coordinator', 'coordinator_id', 'user_id');
    }

    public function agencys()
    {
        return $this->hasOne(User::class, 'coordinator_id');
    }


    public function agency()
    {
        return $this->belongsToMany(User::class, 'user_agency', 'coordinator_id', 'agency_id');
    }

    // En el modelo User
    public function agencies()
    {
        return $this->belongsToMany(User::class, 'user_agency', 'coordinator_id', 'agency_id')
            ->withPivot('id');
    }
}
