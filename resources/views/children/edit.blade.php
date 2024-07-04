<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Anak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('children.update', $child->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Formulir 1 Identitas Anak -->
                        <div class="mb-4">
                            <label for="full_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap Anak:</label>
                            <input type="text" name="full_name" value="{{ $child->full_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="place_of_birth" class="block text-gray-700 text-sm font-bold mb-2">Tempat Lahir:</label>
                            <input type="text" name="place_of_birth" value="{{ $child->place_of_birth }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="date_of_birth" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir:</label>
                            <input type="date" name="date_of_birth" value="{{ $child->date_of_birth }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="father_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap Ayah:</label>
                            <input type="text" name="father_name" value="{{ $child->father_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="mother_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap Ibu:</label>
                            <input type="text" name="mother_name" value="{{ $child->mother_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Formulir 2 Riwayat Gejala -->
                        @if($latestStuntingCheck)
                            <input type="hidden" name="stunting_check_id" value="{{ $latestStuntingCheck->id }}">

                            <div class="mb-4">
                                <label for="height" class="block text-gray-700 text-sm font-bold mb-2">Tinggi Badan (cm):</label>
                                <input type="number" name="height" value="{{ $latestStuntingCheck->height }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div class="mb-4">
                                <label for="weight" class="block text-gray-700 text-sm font-bold mb-2">Berat Badan (kg):</label>
                                <input type="number" name="weight" value="{{ $latestStuntingCheck->weight }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>

                            <div class="mb-4">
                                <label for="is_poor_family" class="block text-gray-700 text-sm font-bold mb-2">Status Keluarga Miskin:</label>
                                <select name="is_poor_family" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="1" {{ $latestStuntingCheck->is_poor_family ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ !$latestStuntingCheck->is_poor_family ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-3 gap-4">
                                @foreach($symptoms as $symptom)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="symptoms[]" value="{{ $symptom->id }}" id="symptom-{{ $symptom->id }}" class="mr-2" {{ in_array($symptom->id, $latestStuntingCheck->symptoms->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label for="symptom-{{ $symptom->id }}" class="text-gray-700">{{ $symptom->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
