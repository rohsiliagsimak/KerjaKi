<x-app-layout>
    <x-slot name="sidebar">
        @include('components.sidebar')
    </x-slot>
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">
                        {{ $employerProfile->company_name }}'s Profile
                    </h2>
                </div>

                <!-- Profile Content -->
                <div class="p-6">
                    <!-- Company Logo Section -->
                    <div class="mb-8 flex justify-center">
                        @if(!empty($employerProfile->logo))
                            <img src="{{ $employerProfile->logo }}" 
                                 alt="Company Logo" class="h-32 w-32 object-cover rounded-full">
                        @endif
                    </div>

                    <!-- Company Details -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Company Description</h3>
                        <p>{{ $employerProfile->company_description }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Industry</h3>
                        <p>{{ $employerProfile->industry }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Website</h3>
                        <p><a href="{{ $employerProfile->website }}" class="text-blue-500">{{ $employerProfile->website }}</a></p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Phone</h3>
                        <p>{{ $employerProfile->phone }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Address</h3>
                        <p>{{ $employerProfile->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>