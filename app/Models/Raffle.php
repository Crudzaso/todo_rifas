<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'lottery',
        'active',
        'type',
        'raffle_date',
        'tickets_count',
        'ticket_price',
        'total_bet_pool',

    ];

    /**
     * metodo para calcular la posible ganancia de la rifa
     *
    */

    public function getPotentialGain()
    {
        return $this->ticket_count * $this->ticket_price;
    }


/**
 * metodo para calcular la ganancia real teniendo en cuenta
 * las boletas vendidas
 * se tiene en cuenta que el estado de la boleta sea pagado
*/
public function getActualGain()
    {
        $soldTicketsCount = $this->entries()->where('status', 'paid')->count();
        return $soldTicketsCount * $this->ticket_price;
    }





    public function entries()
    {
        return $this->hasMany(RaffleEntries::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
