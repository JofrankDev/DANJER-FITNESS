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

    protected $casts = [
        'date' => 'date',
        'start_datetime' => 'datetime:H:i',
    ];

    public function trainer() : BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }
    public function clients() : BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_sessions', 'session_id', 'client_id')
            ->withPivot('status', 'attendance', 'reserved_at', 'cancelled_at')
            ->withTimestamps();
    }

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function classType() : BelongsTo
    {
        return $this->belongsTo(ClassType::class);
    }

    // Accessor para obtener la hora de finalización
    public function getEndTimeAttribute()
    {
        $start = \Carbon\Carbon::parse($this->start_datetime);
        return $start->addMinutes($this->duration_minutes)->format('H:i');
    }

    // Accessor para obtener el día de la semana traducido
    public function getDayNameAttribute()
    {
        return $this->date->translatedFormat('l');
    }

}
