<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Ticket;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;

class ReplyController extends Controller
{
    public function store(StoreReplyRequest $request, Ticket $ticket)
    {
        $ticket->replies()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]);
        
        return redirect()->route('ticket.show', $ticket->id);
    }

    public function edit(Reply $reply)
    {
        $this->authorize('update', $reply);
        return view('reply.edit', compact('reply'));
    }
    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->update($request->validated());
        return redirect()->route('ticket.show', $reply->ticket->id);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();
        return redirect()->route('ticket.show', $reply->ticket->id);
    }
}