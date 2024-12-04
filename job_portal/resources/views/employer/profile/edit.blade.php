<x-app-layout>
    <x-slot name="sidebar">
        @include('components.sidebar')
    </x-slot>
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Employer Profile</h1>
                <p class="text-gray-600">Update your company information and details</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('employers.update', $employerProfile->user_id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Section -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" 
                                           class="bg-gray-100 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-600" 
                                           id="name" 
                                           name="name" 
                                           value="{{ $user->name }}" 
                                           disabled>
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" 
                                           class="bg-gray-100 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-600" 
                                           id="email" 
                                           name="email" 
                                           value="{{ $user->email }}" 
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <!-- Company Information Section -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-4">Company Information</h2>
                            
                            <!-- Company Name Field -->
                            <div class="mb-4">
                                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Company Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                       id="company_name" 
                                       name="company_name" 
                                       value="{{ $employerProfile->company_name }}" 
                                       required>
                            </div>

                            <!-- Company Description Field -->
                            <div class="mb-4">
                                <label for="company_description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Company Description
                                </label>
                                <textarea
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    id="company_description"
                                    name="company_description"
                                    rows="4"
                                >{{ $employerProfile->company_description }}</textarea>
                            </div>

                            <!-- Industry & Website Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                                    <input type="text" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                           id="industry" 
                                           name="industry" 
                                           value="{{ $employerProfile->industry }}">
                                </div>

                                <div>
                                    <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                    <input type="url" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                           id="website" 
                                           name="website" 
                                           value="{{ $employerProfile->website }}">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h2 class="text-lg font-semibold text-gray-700 mb-4">Contact Information</h2>
                            
                            <!-- Phone & Address Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input type="text" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ $employerProfile->phone }}">
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                           id="address" 
                                           name="address" 
                                           value="{{ $employerProfile->address }}">
                                </div>
                            </div>

                            <!-- Logo Field -->
                            <div>
                                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo URL</label>
                                <input type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                       id="logo" 
                                       name="logo" 
                                       value="{{ $employerProfile->logo }}">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
