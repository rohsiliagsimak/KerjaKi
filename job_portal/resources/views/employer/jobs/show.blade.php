<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Detail Lowongan Pekerjaan</h2>
            <a href="{{ route('employer.jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-4">
            <h3 class="text-xl font-bold mb-2">{{ $job->title }}</h3>
            <p class="text-gray-700 mb-4"><strong>Lokasi:</strong> {{ $job->location }}</p>
            <p class="text-gray-700 mb-4"><strong>Tipe Pekerjaan:</strong> {{ $job->job_type }}</p>
            <p class="text-gray-700 mb-4"><strong>Kisaran Gaji:</strong> {{ $job->salary }}</p>
            <p class="text-gray-700 mb-4"><strong>Status:</strong> {{ $job->status }}</p>

            <h4 class="text-lg font-semibold mt-4">Deskripsi Pekerjaan</h4>
            <p class="text-gray-700 mb-4">{{ $job->description }}</p>

            <h4 class="text-lg font-semibold mt-4">Persyaratan</h4>
            <p class="text-gray-700 mb-4">{{ $job->requirements }}</p>

            @if (Auth::check() && Auth::user()->role === 'employer')
                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('employer.jobs.edit', $job) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mr-2">
                        Edit
                    </a>
                    <form action="{{ route('employer.jobs.destroy', $job) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </button>
                    </form>
                </div>
            @elseif (Auth::check() && Auth::user()->role === 'admin')
                {{-- <div class="text-center text-red-500 font-bold mt-6">
                    Tekan apply untuk melamar pekerjaan
                </div> --}}
            @elseif (Auth::check() && Auth::user()->role === 'job_seeker')
                <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    <div class="mb-4">
                        <label for="cv" class="block text-sm font-medium text-gray-700">Unggah CV</label>
                        <input type="file" name="cv" id="cv" class="mt-1 block w-full">
                        @error('cv')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Apply Now
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>