<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'emergency_phone',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sessions() : BelongsToMany
    {
        return $this->belongsToMany(Session::class, 'client_sessions', 'client_id', 'session_id')
            ->withPivot('status', 'attendance', 'reserved_at', 'cancelled_at')
            ->withTimestamps();
    }

    public function memberships() : HasMany
    {
        return $this->hasMany(Membership::class);
    }

}
