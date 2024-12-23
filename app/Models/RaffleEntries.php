<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleEntries extends Model
{
    use HasFactory;

    protected $fillable = [
        'raffle_id',
        'number',
        'price',
        'type',
        'user_id',
        'bet_amount',
        'status',
    ];

    protected $dates = [
        'reservation_expires_at',
    ];


    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
