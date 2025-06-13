<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'body',
        'status_id',
        'user_id',
    ];

    public function status()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
