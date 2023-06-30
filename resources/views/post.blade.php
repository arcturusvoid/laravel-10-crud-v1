<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You can post your thoughts here
                </div>
                <form action="{{ route('post.store') }}" method="post">
                    @csrf
                    <div class="p-2">
                        <div class="flex-row">
                            <div class="">
                                <div class="container p-5">
                                    <h1 class="text-2xl font-bold mb-4 text-white">Add post</h1>
                                    <textarea id="message" name="content" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4"
                                        placeholder="Write your thoughts here..." required></textarea>
                                    <x-input-error class="mb-2" :messages="$errors->get('content')" />
                                    @if (session('status') === 'post-added')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                                            class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('Saved.') }}
                                        </p>
                                    @endif
                                    <input
                                        class="h-8 px-4 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg cursor-pointer focus:shadow-outline hover:bg-indigo-800"
                                        type="submit" value="Post">
                                </div>
                            </div>

                            <div class="">
                                <div class="container p-5">
                                    <h1 class="text-2xl font-bold mb-4 text-white">Posts</h1>
                                    <div class="flex flex-col gap-4">
                                        @foreach ($posts as $post)
                                            <div
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4">
                                                <h3
                                                    class="text-xl font-semibold mb-2 {{ auth()->user()->id == $post->user->id ? 'text-white-400' : 'text-gray-400' }}">
                                                    {{ $post->user->name }}
                                                </h3>
                                                <div class="text-white overflow-auto h-33 break-words">
                                                    {{ $post->content }}.
                                                    @if (auth()->user()->id == $post->user_id)
                                                        <div class="flex inline-flex space-x-0">
                                                            <button
                                                                class="inline-flex items-center justify-end w-8 h-8 mr-2 rounded-full text-sky-500 transition-colors duration-150 ">
                                                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                                    <path
                                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                            <button
                                                                class="inline-flex items-center justify-start w-8 h-8 mr-2 rounded-full text-red-400 transition-colors duration-150">
                                                                <svg fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" class="w-3 h-3 fill-current"
                                                                    viewBox="0 0 20 20">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p class="text-gray-500 italic text-sm mt-2">
                                                    {{ $post->created_at->format('g:i A j F, Y') }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
