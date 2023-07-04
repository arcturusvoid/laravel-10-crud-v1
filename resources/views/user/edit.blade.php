<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="container">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            Update User
                        </div>
                        <div class="px-6">
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @method('patch')
                                @csrf
                                <div class="mb-4">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" type="text" name="name"
                                        value="{{ $user->name }}" class="block mt-1 w-1/2" autofocus required />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" type="email" name="email"
                                        value="{{ $user->email }}" class="block mt-1 w-1/2" autofocus required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="mb-4 text-gray-900 dark:text-gray-100">
                                    <label for="role"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select
                                        an option</label>
                                    <select name="role" id="role"
                                        class="text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-1/4">
                                        <option value="user" selected>User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>
                                <x-primary-button type="submit " class="mb-4 ">{{ __('Update User') }}</x-primary-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
