<x-app-layout>
    {{-- <x-slot name="sidebar">
        @include('components.sidebar')
    </x-slot> --}}

    <x-sidebar/>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <!-- Header dengan Create New User Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Management') }}
            </h2>
            <a href="{{ route('admin.create') }}" 
                class="px-4 py-2 bg-blue-500 text-white text-sm rounded-md hover:bg-blue-600">
                {{ __('Create New User') }}
            </a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.index') }}">
            <div class="grid grid-cols-3 gap-2 items-center mb-4">
                <!-- Category Dropdown -->
                <div class="relative">
                    <label for="category" class="sr-only">Category</label>
                    <button id="dropdown-button" data-dropdown-toggle="dropdown" 
                            class="flex justify-center items-center text-center py-2 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-lg w-full dark:bg-gray-700 dark:text-white dark:border-gray-600 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:hover:bg-gray-600 dark:focus:ring-gray-800"
                            type="button">
                        {{ request('category') ?: 'All categories' }}
                    </button>
                    <div id="dropdown" class=" z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                            <li><a href="?category=employer" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Employer</a></li>
                            <li><a href="?category=job_seeker" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Job Seeker</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Search Input -->
                <div class="relative col-span-2">
                    <input type="text" name="search" id="search-dropdown" 
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="Search by Username" value="{{ request('search') }}">
                    <button type="submit" 
                            class="absolute top-0 right-0 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>

        <!-- User Table -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                @if ($user->role !== 'admin')
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}
                    </th>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">{{ $user->role }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.edit', $user->id) }}" 
                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        
                        <!-- Form untuk Delete -->
                        <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                    onclick="return confirm('{{ __('Are you sure?') }}');">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
