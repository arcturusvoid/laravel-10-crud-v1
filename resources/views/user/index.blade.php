<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    @if (session('user-status') === 'updated')
        <x-alert-success :message="'User Updated'"></x-alert-success>
    @endif

    @if (session('user-status') === 'deleted')
        <x-alert-danger :message="'User Deleted'"></x-alert-danger>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <div class="w-full flex items-center font-sans overflow-hidden">
                            <div class="w-full">
                                <div class="bg-gray-800 shadow-md rounded my-6">
                                    <table class="w-full table-auto rounded-lg">
                                        <thead>
                                            <tr
                                                class="bg-gray-800 text-white uppercase text-sm leading-normal border-b border-gray-500">
                                                <th class="py-3 px-6 text-left">Name</th>
                                                <th class="py-3 px-6 text-left">Email</th>
                                                <th class="py-3 px-6 text-center">Tickets</th>
                                                <th class="py-3 px-6 text-center">Role</th>
                                                <th class="py-3 px-6 text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-white text-sm font-light">
                                            @forelse ($users as $user)
                                                <tr class="border-b border-gray-700">
                                                    <td class="py-3 px-6 text-left">
                                                        <div class="flex items-center">
                                                            <div class="mr-2">
                                                                <img class="w-6 h-6 rounded-full"
                                                                    src="/storage/{{ $user->avatar }}" />
                                                            </div>
                                                            <span>{{ $user->name }}</span>
                                                        </div>
                                                    </td>
                                                    
                                                    <td class="py-3 px-6">
                                                        <span>{{ $user->email }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span
                                                            class="text-white py-1 px-3 text-sm">{{ $user->tickets_count }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span
                                                            class="bg-indigo-500 text-white py-1 px-3 rounded-full text-sm capitalize">{{ $user->role }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <div class="flex item-center justify-center">
                                                            <div
                                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                                <a href="{{ route('user.edit', $user->id) }}"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                    </svg></a>

                                                            </div>
                                                            <div>
                                                                <form action="{{ route('user.destroy', $user->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="w-4 mr-2 transform hover:text-red-500 hover:scale-110"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="border-b border-gray-800">
                                                    No user yet
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="mt-7"> {{ $users->links() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
