<?php

namespace App\Notifications;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TicketStatusChange extends Notification
{
    use Queueable;

    public function __construct(public Ticket $ticket)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting("Hello $notifiable->name")
                    ->line('Ticket is Updated')
                    ->action('Check your ticket at ', route('ticket.show', $this->ticket->id))
                    ->line('Thank you for using our application!');
    }

    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
