<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizerRequest extends Model
{
    use HasFactory;

    // Define la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'reason',
        'document_number',
        'document_photo',
        'contract',
        'status',
    ];
}
