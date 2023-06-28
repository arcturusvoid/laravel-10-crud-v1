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
                        <hr class="w-64 h-px my-3 bg-gray-200 border-0 dark:bg-gray-700 mb-3 mt-6">
                        @if ($ticket->attachment != null)
                            <a href="/storage/{{ $ticket->attachment }}"
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

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-white dark:bg-gray-900 py-4 lg:py-16">
                <div class="max-w-4xl mx-auto px-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion
                            ({{ $ticket->replies->count() }})</h3>
                    </div>
                    @foreach ($ticket->replies as $reply)
                        <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-800">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                                            class="mr-2 w-6 h-6 rounded-full" src="/storage/{{ $reply->user->avatar }}"
                                            alt="{{ $reply->user->name }}">{{ $reply->user->role === 'admin' ? $reply->user->name . ' (Admin)' : $reply->user->name . ' (You)' }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $reply->created_at->format('M. d, Y') }}</p>
                                </div>
                                @if (auth()->user()->id === $reply->user_id || auth()->user()->role === 'admin')
                                    <div x-data="{ open: false }" class="relative inline-block">
                                        <button id="dropdownComment1Button"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            type="button" @click="open = !open" aria-haspopup="true"
                                            :aria-expanded="open.toString()">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                </path>
                                            </svg>
                                            <span class="sr-only">Comment settings</span>
                                        </button>

                                        <!-- Dropdown menu -->
                                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="absolute right-0 mt-2 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                                            @click.away="open = false" x-ref="dropdownComment1" x-cloak>
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <a href="{{ route('reply.edit', [$reply->ticket, $reply->id]) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                </li>
                                                <form action="{{ route('reply.destroy', $reply->id) }}" method="post"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    <li>
                                                        @csrf
                                                        @method('delete')
                                                        <button>Remove</button>
                                                    </li>
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </footer>
                            <p class="text-gray-500 dark:text-gray-400">{{ $reply->body }}</p>

                            @if ($reply->created_at != $reply->updated_at)
                                <span class="text-gray-500 dark:text-gray-600 italic">edited</span>
                            @endif

                        </article>
                    @endforeach
                </div>
                <form class="mb-6" method="post" action="{{ route('reply.store', $ticket->id) }}">
                    @csrf
                    <div
                        class="py-2 px-4 mb-2 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <label for="body" class="sr-only">Your comment</label>
                        <textarea id="body" name="body" rows="6"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="Write a comment..." required></textarea>

                    </div>
                    <x-input-error :messages="$errors->get('body')" class="mb-2 mt-2" />
                    <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-1 rounded-lg">
                        Post Reply
                    </button>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
