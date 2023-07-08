<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'attachment',
        'user_id',
        'status',
        'status_changed_by_id',
        'status_changed_at',
        'ticket_category_id',
    ];

    protected $casts = [
        'status_changed_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function category(){
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }

    public function statusChangedBy()
    {
        return $this->belongsTo(User::class, 'status_changed_by_id');
    }
}
