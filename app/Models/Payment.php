<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'amount',
        'payment_date'
    ];

    public function membership() : BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }
}
