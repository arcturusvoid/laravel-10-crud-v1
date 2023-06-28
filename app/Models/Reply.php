<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id',
        'ticket_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }
}
