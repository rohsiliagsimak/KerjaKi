
<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-semibold mb-6">Applicant Management</h2>
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Seeker</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CV</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied At</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($applications as $application)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $application->job->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $application->jobSeeker->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><a href="{{ asset('storage/' . $application->cv) }}" target="_blank" class="text-blue-500 underline">View CV</a></td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $application->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $application->applied_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $application->updated_at }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('employer.applications.updateStatus', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select">
                                        <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accept</option>
                                        <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-2">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>