<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    @if (session('status') === 'ticket-added')
        <x-alert-success class="z-50" :message="'Ticket added!'"></x-alert-success>
    @endif

    @if (session('status') === 'ticket-updated')
        <x-alert-success class="z-50" :message="'Ticket updated!'"></x-alert-success>
    @endif

    @if (session('status') === 'ticket-deleted')
    <x-alert-danger class="z-50" :message="'Ticket deleted!'"></x-alert-danger>
@endif

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mb-5">
            <a class="text-md p-2 rounded-lg bg-indigo-500 text-gray-300" href="{{ route('ticket.create') }}">New
                Ticket</a>
        </div>
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @admin
                            User's Ticket List
                        @else
                            Your Ticket List
                        @endadmin
                    </div>
                    <div class="p-5">
                        <table class="table-fixed w-full">
                            <thead>
                                <tr>
                                    <th class="mb-3 text-gray-900 dark:text-gray-100 pb-3">Ticket Title</th>
                                    <th class="mb-3 text-gray-900 dark:text-gray-100 pb-3">Ticket Category</th>
                                    <th class="mb-3 text-gray-900 dark:text-gray-100 pb-3">Ticket Created Date</th>
                                    <th class="mb-3 text-gray-900 dark:text-gray-100 pb-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets as $ticket)
                                    <tr>
                                        <td
                                            class="hover:text-indigo-400 pl-3 mb-2 dark:text-gray-300 text-start pb-3 overflow-hidden">
                                            <a class="truncate text-ellipsis"
                                                href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}">{{ $ticket->title }}</a>
                                        </td>

                                        <td
                                            class="hover:text-indigo-400 pl-3 mb-2 dark:text-gray-300 text-center pb-3 capitalize">
                                            <a
                                                href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}">{{ $ticket->category->name}}</a>
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
                    <div class="p-5">{{ $tickets->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
