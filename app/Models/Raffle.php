<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'lottery',
        'active',
        'type',
        'raffle_date'=>'datetime',
        'tickets_count',
        'ticket_price',

    ];

    public function entries()
    {
        return $this->hasMany(RaffleEntries::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
