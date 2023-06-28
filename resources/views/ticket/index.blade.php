<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if (auth()->user()->role === 'admin')
                            User's Ticket List
                        @else
                            Your Ticket List
                        @endif
                    </div>
                    <div class="p-5">
                        <table class="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th class="mb-3 text-gray-900 dark:text-gray-100 pb-3">Ticket Title</th>
                                    <th class="mb-3 text-gray-900 dark:text-gray-100 pb-3">Ticket Created Date</th>
                                    <th class="mb-3 text-gray-900 dark:text-gray-100 pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets as $ticket)
                                    <tr>
                                        <td class="hover:text-indigo-400 pl-3 text-center mb-2 dark:text-gray-300 text-start pb-3 overflow-hidden">
                                            <a class="truncate text-ellipsis" href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}">{{ $ticket->title }}</a>
                                        </td>
                                        
                                        <td class="hover:text-blue-400 text-center mb-2 dark:text-gray-300"> <a
                                                href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}">{{ $ticket->created_at->diffForHumans() }}
                                            </a>
                                        </td>
                                        <td
                                            class="text-center capitalize dark:{{ $ticket->status === 'open' ? 'text-gray-400' : ($ticket->status === 'resolved' ? 'text-green-400' : 'text-red-400') }}">
                                            <a
                                                href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}">{{ $ticket->status }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <p class="px-6 pb-6 text-gray-900 dark:text-gray-100">
                                        {{ auth()->user()->role === 'admin' ? "There's no tickets yet." : "You don't have any tickets yet." }}
                                    </p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
