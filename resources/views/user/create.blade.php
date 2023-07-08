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
                        Create a new User
                    </div>
                    <div class="px-6">
                        <form action="{{ route('user.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <x-input-label for="title" :value="__('Name')" />
                                <x-text-input id="name" type="text" name="name" value="{{ old('name') }}"
                                    class="block mt-1 w-full" autofocus required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="block mt-1 w-full" autofocus required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Role')" />
                                <select name="role" id="role"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-1/2">
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="mb-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <x-primary-button class="mb-4 ">{{ __('Create User') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>