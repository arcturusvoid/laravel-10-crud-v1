<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    @if (session('status') === 'reply-added')
        <x-alert-success :message="'Reply added!'" />
    @endif

    @if (session('status') === 'reply-updated')
        <x-alert-success :message="'Reply updated!'" />
    @endif

    @if (session('status') === 'reply-deleted')
        <x-alert-danger :message="'Reply deleted!'" />
    @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="p-6 flex justify-between items-center">
                        <span class="text-gray-900 dark:text-gray-100">Ticket Title: <b>{{ $ticket->title }}</b></span>
                        
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                </path>
                                            </svg>
                                            <span class="sr-only">Comment settings</span>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('ticket.edit', $ticket->id)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('ticket.destroy', $ticket->id) }}">
                                        @csrf
                                        @method('delete')

                                        <x-dropdown-link :href="route('ticket.destroy', $ticket->id)"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    <div class="px-6 mb-3 text-gray-900 dark:text-gray-100">
                        <p class="text-white overflow-auto break-words">Ticket Description:
                            <b>{{ $ticket->description }}</b>
                        </p>

                        <p class="text-white mt-2 capitalize">Ticket Category: <b>{{ $ticket->category->name }}</b>
                        </p>

                        <hr class="w-64 h-px my-3 bg-gray-200 border-0 dark:bg-gray-700 mb-3 mt-6">
                        @if ($ticket->attachment != null)
                            <a href="/storage/{{ $ticket->attachment }}" target="_blank">View Attachment</a>
                        @endif
                        <div class="flex justify-{{ auth()->user()->role === 'admin' ? 'end' : 'between' }}">
                            @admin
                                <div>
                                    <div class="inline-flex">
                                        <form action="{{ route('ticket.update.status', $ticket->id) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <input type="hidden" name="status" value="resolved">
                                            <x-primary-button class="">Resolve</x-primary-button>
                                        </form>

                                        <form action="{{ route('ticket.update.status', $ticket->id) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <x-danger-button class="ml-2">Reject</x-danger-button>
                                        </form>
                                    </div>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2 " />
                                </div>
                            @else
                                <p class="px-6 pb-6 text-gray-900 dark:text-gray-100 capitalize">Status:
                                    {{ $ticket->status }}</p>
                            @endadmin
                        </div>
                        @admin
                            <p class="text-gray-900 dark:text-gray-100 capitalize">Created by:
                                {{ $ticket->user->name }}
                                <p class="text-gray-400 mt-2 italic">Posted: {{ $ticket->created_at->diffForHumans() }}</p>
                            </p>
                        @endadmin

                        @if ($ticket->status_changed_by_id)
                            <hr class="w-64 h-px my-3 bg-gray-200 border-0 dark:bg-gray-700 mb-3 mt-6">
                            <p class="text-gray-400 mt-2 capitalize">Status changed by:
                                <span class="italic">
                                    {{ $ticket->statusChangedBy->name . ' ' . "({$ticket->statusChangedBy->role})" }}</span>
                            </p>
                            <p class="text-gray-400 mt-2 capitalize">Status changed at:
                                <span class="italic">{{ $ticket->status_changed_at->diffForHumans() }}</span>
                            </p>
                        @endif

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

                    @forelse ($replies as $reply)
                        <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-800">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p
                                        class="inline-flex items-center mr-1 text-sm text-gray-900 dark:text-white capitalize">
                                        <img class="mr-1 w-6 h-6 rounded-full"
                                            src="/storage/{{ $reply->user->avatar }}" alt="">
                                        {{ $reply->user->name . ' (' . $reply->user->role . ')' }}
                                    </p>

                                    <p class="text-sm text-gray-600 dark:text-gray-400">•
                                        {{ $reply->created_at->diffForHumans() }}</p>

                                    @if ($reply->created_at->lt($reply->updated_at))
                                        <span class="text-sm text-gray-500 dark:text-gray-600 italic ml-1">•
                                            edited</span>
                                    @endif
                                </div>
                                @can('update', $reply)
                                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                    <div>
                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                            </path>
                                                        </svg>
                                                        <span class="sr-only">Comment settings</span>
                                                    </div>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('reply.edit', $reply->id)">
                                                    {{ __('Edit') }}
                                                </x-dropdown-link>

                                                <form method="POST" action="{{ route('reply.destroy', $reply->id) }}">
                                                    @csrf
                                                    @method('delete')

                                                    <x-dropdown-link :href="route('reply.destroy', $reply->id)"
                                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                        {{ __('Delete') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                @endcan
                            </footer>
                            <p class="text-gray-500 dark:text-gray-400">{{ $reply->body }}<a /p>



                        </article>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Theres no discussion yet, make some!</p>
                    @endforelse
                    <div class="py-3"> {{ $replies->links() }}</div>

                </div>
                <form class="mb-6" method="post" action="{{ route('reply.store', $ticket->id) }}">
                    @csrf
                    <div
                        class="py-2 px-4 mb-2 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <label for="body" class="sr-only">Your comment</label>
                        <textarea id="body" name="body" rows="6"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="Write a comment..." required>{{ old('body') }}</textarea>

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
