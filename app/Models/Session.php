<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';

    protected $fillable = [
        'trainer_id',
        'room_id',
        'class_type_id',
        'name',
        'description',
        'capacity',
        'date',
        'start_datetime',
        'duration_minutes',
        'status',
    ];

    public function trainer() : BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }
    public function clients() : BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_sessions', 'session_id', 'client_id')->withPivot('status')->withTimestamps();
    }

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function classType() : BelongsTo
    {
        return $this->belongsTo(ClassType::class);
    }

}
