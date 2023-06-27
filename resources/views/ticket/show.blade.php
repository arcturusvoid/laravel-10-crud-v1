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
                        Ticket Title: <b>{{ $ticket->title }}</b>
                    </div>

                    <div class="px-6 mb-3 text-gray-900 dark:text-gray-100">
                        <p class="text-white overflow-auto break-words">Ticket Description: {{ $ticket->description }}
                        </p>
                        <hr class="w-48 h-1 my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">
                        @if ($ticket->attachment)
                            <a href="/storage/{{ $ticket->attachment != null ? $ticket->attachment : '' }}"
                                target="_blank">View Attachment</a>
                        @endif
                        <div class="flex justify-{{ auth()->user()->role === 'admin' ? 'end' : 'between' }}">
                            @if (auth()->user()->role === 'admin')
                                <div>
                                    <div class="inline-flex">
                                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <input type="hidden" name="status" value="resolved">
                                            <x-primary-button class="">Approve</x-primary-button>
                                        </form>

                                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <x-danger-button class="ml-2">Reject</x-danger-button>
                                        </form>
                                    </div>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2 " />
                                </div>
                            @else
                                <div class="inline-flex">
                                    <form action="{{ route('ticket.edit', $ticket->id) }}" method="get">
                                        <button
                                            class="w-4 h-8 mr-2 rounded-full text-gray-500 transition-colors duration-150">
                                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            class="w-4 h-8 rounded-full text-gray-500 transition-colors duration-150">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <p class="px-6 pb-6 text-gray-900 dark:text-gray-100 capitalize">Status:
                                    {{ $ticket->status }}</p>
                            @endif
                        </div>

                        @if (auth()->user()->role === 'admin')
                            <p class="text-gray-900 dark:text-gray-100 capitalize">Created by:
                                {{ $ticket->user->name }}
                            </p>
                        @endif
                        <p class="text-gray-400 mt-2">{{ $ticket->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
