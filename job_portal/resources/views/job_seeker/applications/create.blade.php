<x-app-layout>
    <x-slot name="sidebar">
        @include('components.sidebar')
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">
                Apply for Job: <span class="text-blue-600">{{ $jobPost->title }}</span>
            </h1>

            <form action="{{ route('applied_jobs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_job_id" value="{{ $jobPost->id }}">

                <div class="mb-6">
                    <label for="cv" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload CV
                    </label>
                    <input type="file" name="cv" id="cv" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="text-right">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Apply
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>