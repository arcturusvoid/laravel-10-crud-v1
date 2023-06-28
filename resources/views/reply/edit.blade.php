<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <section class="bg-white dark:bg-gray-900 py-4 lg:py-16">
                <div class="mb-4 text-gray-900 dark:text-gray-100">
                    Edit your reply
                </div>
                <form class="mb-6" method="post" action="{{ route('reply.update', $reply->id) }}">
                    @csrf
                    @method('patch')
                    <div
                        class="py-2 px-4 mb-2 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <label for="body" class="sr-only">Your comment</label>
                        <textarea id="body" name="body" rows="6"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="Write a comment..." required>{{ $reply->body }}</textarea>

                    </div>
                    <x-input-error :messages="$errors->get('body')" class="mb-2 mt-2" />
                    <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-1 rounded-lg">
                        Save Reply
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
