<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{

    protected $table = 'winner';

    protected $fillable = [
        'participant_name',
        'lottery',
        'winning_number',
        'lottery_date',
    ];
}
