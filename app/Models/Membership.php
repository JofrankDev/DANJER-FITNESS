<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'plan_id',
        'status',
    ];

    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
