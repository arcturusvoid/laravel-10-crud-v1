<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    @if (session('status') === 'post-added')
        <x-alert-success :message="'Post added!'"></x-alert-success>
    @endif

    @if (session('status') === 'post-updated')
        <x-alert-success :message="'Post updated!'"></x-alert-success>
    @endif

    @if (session('status') === 'post-deleted')
        <x-alert-danger :message="'Post deleted!'"></x-alert-danger>
    @endif

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mb-5">
            <a class="text-md p-2 rounded-lg bg-indigo-500 text-gray-300" href="{{ route('post.create') }}">New Post</a>
        </div>
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    You can post your thoughts here
                </div>
                <div class="p-2">
                    <div class="">
                        <div class="container p-5">
                            <h1 class="text-2xl font-bold mb-4 text-white">Posts ({{ $posts->count() }})</h1>
                            <div class="grid grid-cols-1 gap-4">
                                @foreach ($posts as $post)
                                    <div
                                        class="p-2.5 text-sm rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4">
                                        <div class="flex items-center">
                                            @if ($post->user->avatar)
                                                <img class="rounded-full w-8 h-7 mr-2"
                                                    src="/storage/{{ $post->user->avatar }}"
                                                    alt="{{ $post->user->name }}">
                                            @endif

                                            <h3
                                                class="text-lg font-semibold {{ auth()->user()->id == $post->user->id ? 'text-white-400' : 'text-gray-400' }}">
                                                {{ $post->user->name }}
                                            </h3>
                                            <span class="text-gray-500 italic ml-2"> •
                                                {{ $post->created_at->diffForHumans() }}</span>
                                        </div>

                                        <div class="overflow-auto break-words w-full px-2 mt-2">
                                            <span class="text-white text-sm">{{ $post->content }}</span>

                                            @can('view', $post)
                                                <div class="flex inline-flex">
                                                    <a href="{{ route('post.edit', $post->id) }}"
                                                        class="inline-flex items-center justify-end ml-2 rounded-full text-sky-500 transition-colors duration-150">
                                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="flex justify-start ml-2 rounded-full text-red-400 transition-colors duration-150">
                                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
