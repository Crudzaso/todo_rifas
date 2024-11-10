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
        'raffle_date',
        'tickets_count',
        'ticket_price',
        'amount'
    ];

    public function entries()
    {
        return $this->hasMany(RaffleEntries::class);
    }
}