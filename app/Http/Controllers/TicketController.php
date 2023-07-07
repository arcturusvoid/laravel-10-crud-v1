<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    public function index(Request $request)
    {

        $tickets = $request->user()->role === 'admin' ?
            Ticket::orderByDesc('updated_at')->paginate(10) : $request->user()->tickets()->orderByDesc('updated_at')->paginate(10);

        return view('ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('ticket.create');
    }

    public function store(StoreTicketRequest $request)
    {
        $path = null;
        if ($request->has('attachment')) {
            $path = $request->file('attachment')->store('ticketAttachments', 'public');
        }

        $request->user()->tickets()->create([
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $path,
        ]);

        return redirect()->route('ticket.create')->with('status', 'ticket-added');
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        $replies = $ticket->replies()->with('user')->paginate(10);
    
        return view('ticket.show', compact('ticket', 'replies'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        return view('ticket.edit', compact('ticket'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        if (auth()->user()->role === 'admin') {
            $ticket->update($request->only('status'));
            // $ticket->user->notify(new TicketStatusChange($ticket));
            // return (new TicketStatusChange($ticket))->toMail($ticket->user);

            return redirect()->route('ticket.index');
        } else {
            $path = null;
            if ($request->attachment) {
                if ($ticket->attachment) {
                    Storage::disk('public')->delete($ticket->attachment);
                }

                $path = $request->file('attachment')->store('ticketAttachments', 'public');
            }
            $ticket->update(array_merge($request->validated(), ['attachment' => $path]));
            return redirect()->route('ticket.index');
        }
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        if ($ticket->attachment) {
            Storage::disk('public')->delete($ticket->attachment);
        }
        $ticket->delete();
        return redirect()->route('ticket.index');
    }
}