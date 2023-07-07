<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-6">
        <div class="flex-row">
            <div class="">
                <div class="container p-5 dark:bg-gray-800 rounded-lg mt-4">
                    <form action="{{ route('post.update', $post->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <h1 class="text-2xl font-bold mb-4 text-white">Update post</h1>
                        <textarea id="message" name="content" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4"
                            placeholder="Write your thoughts here..." required>{{ $post->content }}</textarea>
                        <x-input-error class="mb-2" :messages="$errors->get('content')" />
                        <input
                            class="h-8 px-4 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg cursor-pointer focus:shadow-outline hover:bg-indigo-800"
                            type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
