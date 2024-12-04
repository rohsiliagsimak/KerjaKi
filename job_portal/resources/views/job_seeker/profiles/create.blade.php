<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        @if(isset($profile))
            <a href="{{ route('job_seeker.profile.show', ['id' => $profile->id]) }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                Lihat Profil
            </a>
        @endif

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
            <form action="{{ route('job_seeker.profile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="full_name">
                        Nama Lengkap
                    </label>
                    <input type="text" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('full_name') border-red-500 @enderror" 
                        id="full_name" 
                        name="full_name" 
                        value="{{ old('full_name') }}" 
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date_of_birth">
                        Tanggal Lahir
                    </label>
                    <input type="date" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('date_of_birth') border-red-500 @enderror" 
                        id="date_of_birth" 
                        name="date_of_birth" 
                        value="{{ old('date_of_birth') }}" 
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                        Jenis Kelamin
                    </label>
                    <select name="gender" id="gender" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('gender') border-red-500 @enderror" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        Nomor Telepon
                    </label>
                    <input type="text" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                        Alamat
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" 
                            id="address" 
                            name="address" 
                            rows="4" 
                            required>{{ old('address') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="bio">
                        Biografi
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('bio') border-red-500 @enderror" 
                            id="bio" 
                            name="bio" 
                            rows="4" 
                            required>{{ old('bio') }}</textarea>
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
                                    class="ml-2 bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                +
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Profil
                    </button>
                </div>
            </form>
        </div>
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