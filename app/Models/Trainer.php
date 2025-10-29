<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'speciality',
        'years_of_experience'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sessions() : HasMany
    {
        return $this->hasMany(Session::class);
    }
}
