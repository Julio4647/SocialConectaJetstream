<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoordinator extends Model
{
    protected $table = 'user_coordinator';

    protected $fillable = [
        'user_id',
        'coordinator_id',
    ];

    // Definir la relación con el usuario "community"
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Definir la relación con el coordinador
    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }
}
