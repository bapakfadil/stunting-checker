<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Data Anak - Daftar Gejala') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('children.postCreateStepTwo') }}">
                        @csrf
                        @foreach($symptoms as $symptom)
                        <div class="mb-4">
                            <input type="checkbox" name="symptoms[]" value="{{ $symptom->id }}" id="symptom_{{ $symptom->id }}">
                            <label for="symptom_{{ $symptom->id }}" class="block text-gray-700 text-sm font-bold mb-2">{{ $symptom->name }}</label>
                        </div>
                        @endforeach
                        <div class="flex items-center justify-between">
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
