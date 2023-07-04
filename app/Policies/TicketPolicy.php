<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{

    public function view(User $user, Ticket $ticket): bool
    {
        // Allow access if the user is the ticket owner or an admin
        return $user->id === $ticket->user_id || $user->role === 'admin';
    }

    public function update(User $user, Ticket $ticket): bool
    {
        // Allow access if the user is the ticket owner or an admin
        return $user->id === $ticket->user_id || $user->role === 'admin';
    }

    public function delete(User $user, Ticket $ticket): bool
    {
        // Allow access if the user is the ticket owner or an admin
        return $user->id === $ticket->user_id || $user->role === 'admin';
    }
}
