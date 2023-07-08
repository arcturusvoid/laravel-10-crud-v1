<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = $request->user()->role === 'admin' ?
        Ticket::with('category')->orderByDesc('updated_at')->paginate(10) : $request->user()->tickets()->with('category')->orderByDesc('updated_at')->paginate(10);

        return view('ticket.index', compact('tickets'));
    }

    public function create()
    {
        $ticket_categories = TicketCategory::all();
        return view('ticket.create', compact('ticket_categories'));
    }

    public function store(StoreTicketRequest $request)
    {
        $path = null;
        $ticket = $request->validated();
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('ticketAttachments', 'public');
            $ticket['attachment'] = $path;
        }
      
        $request->user()->tickets()->create($ticket + [
            'ticket_category_id' => $request->category,
        ]);

        return redirect()->route('ticket.index')->with('status', 'ticket-added');
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        $replies = $ticket->replies()
            ->with('user')
            ->paginate(10);
    
        return view('ticket.show', compact('ticket', 'replies'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $ticket_categories = TicketCategory::all();
        return view('ticket.edit', compact('ticket', 'ticket_categories'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $path = null;
        $updated_ticket = $request->validated();
        if ($request->hasFile('attachment')) {
            if ($ticket->attachment) {
                Storage::disk('public')->delete($ticket->attachment);
            }
            $path = $request->file('attachment')->store('ticketAttachments', 'public');
            $updated_ticket['attachment'] = $path;
        }
        $ticket->update(array_merge($updated_ticket));
        return redirect()->route('ticket.index')->with('status', 'ticket-updated');
    }

    public function update_status(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => ['required', 'string', Rule::in(array_column(TicketStatus::cases(), 'value'))],
        ]);

        $ticket->update($request->only('status') + [
            'status_changed_by_id' => $request->user()->id,
            'status_changed_at' => now(),

        ]);

        // $ticket->user->notify(new TicketStatusChange($ticket));
        // return (new TicketStatusChange($ticket))->toMail($ticket->user);

        return redirect()->route('ticket.index')->with('status', 'ticket-updated');
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        if ($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }
        $ticket->delete();
        redirect()->route('ticket.index')->with('status', 'ticket-deleted');
    }
}