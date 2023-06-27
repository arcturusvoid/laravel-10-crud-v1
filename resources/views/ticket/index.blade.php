<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if (auth()->user()->role === 'admin')
                            User's Ticket List
                        @else
                            Your Ticket List
                        @endif
                    </div>
                    <div class="px-6 mb-3 text-gray-900 dark:text-gray-100 flex justify-between">
                        <h3 class="mb-3 text-gray-900 dark:text-gray-100">Ticket Ttitle</h3>
                        <h3 class="mb-3 text-gray-900 dark:text-gray-100">Ticket Created Date</h3>
                    </div>

                    @forelse ($tickets as $ticket)
                        <div class="px-6 mb-3 text-gray-900 dark:text-gray-100 flex justify-between hover:text-indigo-500">
                            <h4><a href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}">{{ $ticket->title }}</a>
                            </h4>
                            <p class="text-gray-100 dark:text-gray-400 hover:text-indigo-500"><a href="{{ route('ticket.show', ['ticket' => $ticket->id]) }}">{{ $ticket->created_at->diffForHumans() }}</a></p>
                        </div>
                        <hr class="px-6 py-2 mx-6">
                    @empty
                        <p class="px-6 pb-6 text-gray-900 dark:text-gray-100">You dont have any ticket yet.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
