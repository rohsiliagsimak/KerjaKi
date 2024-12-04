<x-app-layout>
    <x-slot name="sidebar">
        @include('components.sidebar')
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Application Details
            </h1>
            
            <div class="space-y-4">
                <div>
                    <span class="text-gray-600 font-medium">Job Title:</span>
                    <span class="text-gray-900 font-semibold">{{ $jobApplication->jobPost->title }}</span>
                </div>

                <div>
                    <span class="text-gray-600 font-medium">Status:</span>
                    <span class="text-gray-900 font-semibold">
                        {{ $jobApplication->status }}
                    </span>
                </div>

                <div>
                    <span class="text-gray-600 font-medium">Applied At:</span>
                    <span class="text-gray-900">{{ $jobApplication->applied_at }}</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>