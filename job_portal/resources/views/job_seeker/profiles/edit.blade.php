    <!-- resources/views/job_seeker/profiles/edit.blade.php -->
    <x-app-layout>
        <x-slot name="sidebar">
            @include('components.sidebar')
        </x-slot>

        <div class="container mx-auto px-4 py-6">
            <h2 class="text-2xl font-semibold">Edit Profil Pencari Kerja</h2>
            <form method="POST" action="{{ route('job_seeker.profile.update', $profile->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH') <!-- Jika Anda menggunakan metode PUT untuk pembaruan -->

                <div class="mb-4">
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                        id="full_name" 
                        name="full_name" 
                        value="{{ old('full_name', $profile->full_name) }}" 
                        required>
                </div>

                <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                        id="date_of_birth" 
                        name="date_of_birth" 
                        value="{{ old('date_of_birth', $profile->date_of_birth) }}">
                </div>

                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select id="gender" name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="male" {{ $profile->gender == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ $profile->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone', $profile->phone) }}">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <input type="text" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                        id="address" 
                        name="address" 
                        value="{{ old('address', $profile->address) }}">
                </div>

                <div class="mb-4">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                    <textarea id="bio" name="bio" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                            rows="4">{{ old('bio', $profile->bio) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cv">
                        CV (Upload)
                    </label>
                    <input type="file" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cv') border-red-500 @enderror" 
                    id="cv" 
                    name="cv">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="skills">
                        Skills
                    </label>
                    <div id="skills-container">
                        <div class="flex items-center mb-2">
                            <input type="text" 
                                    name="skills[]" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="Masukkan skill" 
                                    required>
                            <button type="button" 
                                    onclick="addSkillField()" 
                                    class="ml-2 bg-blue-600 hover:bg-blue-700  text-white px-3 py-1 rounded">
                                +
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <script>
            function addSkillField() {
                const container = document.getElementById('skills-container');
                const newField = document.createElement('div');
                newField.classList.add('flex', 'items-center', 'mb-2');
                newField.innerHTML = `
                    <input type="text" 
                            name="skills[]" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            placeholder="Masukkan skill" 
                            required>
                    <button type="button" 
                            onclick="removeSkillField(this)" 
                            class="ml-2 bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        -
                    </button>
                `;
                container.appendChild(newField);
            }
        
            function removeSkillField(button) {
                button.parentElement.remove();
            }
        </script>
    </x-app-layout>