<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTicketOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Get the ticket
        dd($ticket = Ticket::findOrFail($request->route('ticket')));

        // Check if the user is the ticket owner or an admin
        if ($user->id !== $ticket->user_id && !$user->isAdmin()) {
            // Deny access by returning a 403 Forbidden response
            return response('You do not have permission to view this ticket.', 403);
        }

        // Continue with the request
        return $next($request);
    }
}
