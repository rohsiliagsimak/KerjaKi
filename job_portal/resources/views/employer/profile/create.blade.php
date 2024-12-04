<x-app-layout>
    <x-slot name="sidebar">
        @include('components.sidebar')
    </x-slot>
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-green-600 mb-6">Create Employer Profile</h1>
        <form method="POST" action="{{ route('employers.store') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="form-group mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="name" name="name" value="{{ Auth::user()->name }}" disabled>
            </div>
            <div class="form-group mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="email" name="email" value="{{ Auth::user()->email }}" disabled>
            </div>
            <div class="form-group mb-4">
                <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name <span class="text-red-500">*</span></label>
                <input type="text" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="company_name" name="company_name" required>
            </div>
            <div class="form-group mb-4">
                <label for="company_description" class="block text-sm font-medium text-gray-700">Company Description</label>
                <textarea class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="company_description" name="company_description" rows="3"></textarea>
            </div>
            <div class="form-group mb-4">
                <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                <input type="text" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="industry" name="industry">
            </div>
            <div class="form-group mb-4">
                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                <input type="url" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="website" name="website">
            </div>
            <div class="form-group mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="phone" name="phone">
            </div>
            <div class="form-group mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="address" name="address">
            </div>
            <div class="form-group mb-4">
                <label for="logo" class="block text-sm font-medium text-gray-700">Logo URL</label>
                <input type="text" class="form-control mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500" id="logo" name="logo">
            </div>
            <button type="submit" class="btn btn-primary w-full py-2 mt-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-md transition duration-200">Submit</button>
        </form>
    </div>
</x-app-layout>