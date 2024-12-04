<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4">
        <!-- Header dengan Create New Job Button -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Lowongan Pekerjaan') }}
            </h2>
            <a href="{{ route('employer.jobs.create') }}" 
                class="px-4 py-2 bg-blue-500 text-white text-sm rounded-md hover:bg-blue-600">
                {{ __('Buat Lowongan Baru') }}
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Job Table -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Lokasi</th>
                    <th class="px-6 py-3">Tipe</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">{{ $job->title }}</td>
                        <td class="px-6 py-4">{{ $job->location }}</td>
                        <td class="px-6 py-4">{{ $job->job_type }}</td>
                        <td class="px-6 py-4">{{ $job->status }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('employer.jobs.edit', $job) }}" 
                               class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded text-sm mr-1">
                                Edit
                            </a>
                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada lowongan pekerjaan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>