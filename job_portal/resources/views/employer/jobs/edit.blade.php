<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Edit Lowongan Pekerjaan</h2>
            <a href="{{ route('employer.jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Kembali ke Daftar
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Judul Lowongan
                    </label>
                    <input type="text" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $job->title) }}" 
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Deskripsi Pekerjaan
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror" 
                              id="description" 
                              name="description" 
                              rows="4" 
                              required>{{ old('description', $job->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="requirements">
                        Persyaratan
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('requirements') border-red-500 @enderror" 
                              id="requirements" 
                              name="requirements" 
                              rows="4" 
                              required>{{ old('requirements', $job->requirements) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="salary">
                        Kisaran Gaji
                    </label>
                    <input type="text" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('salary') border-red-500 @enderror" 
                           id="salary" 
                           name="salary" 
                           value="{{ old('salary', $job->salary) }}" 
                           required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="location">
                        Lokasi
                    </label>
                    <input type="text" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('location') border-red-500 @enderror" 
                           id="location" 
                           name="location" 
                           value="{{ old('location', $job->location) }}" 
                           required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="job_type">
                        Tipe Pekerjaan
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('job_type') border-red-500 @enderror" 
                            id="job_type" 
                            name="job_type" 
                            required>
                        <option value="">Pilih Tipe Pekerjaan</option>
                        <option value="full-time" {{ old('job_type', $job->job_type) == 'full-time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part-time" {{ old('job_type', $job->job_type) == 'part-time' ? 'selected' : '' }}>Part Time</option>
                        <option value="freelance" {{ old('job_type', $job->job_type) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="contact_email">
                        Email Kontak
                    </label>
                    <input type="email" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('contact_email') border-red-500 @enderror" 
                           id="contact_email" 
                           name="contact_email" 
                           value="{{ old('contact_email', $job->contact_email) }}" 
                           required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="contact_phone">
                        Telepon Kontak
                    </label>
                    <input type="text" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('contact_phone') border-red-500 @enderror" 
                           id="contact_phone" 
                           name="contact_phone" 
                           value="{{ old('contact_phone', $job->contact_phone) }}" 
                           required>
                </div>

                {{-- <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="salary">
                        Gaji
                    </label>
                    <input type="number" 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('salary') border-red-500 @enderror" 
                           id="salary" 
                           name="salary" 
                           value="{{ old('salary', $job->salary) }}" 
                           required>
                </div> --}}

       
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                        Status
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror" 
                            id="status" 
                            name="status" 
                            required>
                        <option value="">Pilih Status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('employer.jobs.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Batal
                    </a>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Lowongan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
