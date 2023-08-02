<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Client extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'last_name', 'phone', 'email', 'plan', 'agencia', 'start_date', 'expiration_date', 'pay_day', 'communitys_id',
    ];

    // Relación con el modelo User (Community)
    public function users()
    {
        return $this->belongsTo(User::class, 'communitys_id');
    }
}
