<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Create a new Ticket
                    </div>
                    <div class="px-6">
                        <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" type="text" name="title" value="{{ old('title') }}"
                                    class="block mt-1 w-full" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea placeholder="Add description" id="description" name="description"
                                    value="{{ old('description') }}" class="block mt-1 w-full" required>
                                </x-textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="category" :value="__('Category')" />
                                <x-input-select name="category" class="block mt-1" :options="$ticket_categories" required />
                                <x-input-error name="category" :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="attachment" :value="__('Attachment (if theres any)')" />
                                <x-text-input id="attachment" name="attachment" type="file" class="mt-1 block w-full"
                                    autofocus />
                                <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                            </div>

                            <x-primary-button class="mb-4 ">{{ __('Create Ticket') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
