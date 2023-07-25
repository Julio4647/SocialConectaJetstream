<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgency extends Model
{
    protected $table = 'user_agency';

    protected $fillable = [
        'agency_id',
        'coordinator_id',
    ];

    // Relación con el usuario "agency"
    public function coordinator()
{
    return $this->belongsTo(User::class, 'coordinator_id', 'id');
}

public function agency()
{
    return $this->belongsTo(User::class, 'agency_id', 'id');
}
}
