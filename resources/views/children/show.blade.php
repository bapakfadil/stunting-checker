<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Anak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Detail Anak</h3>
                    <p><strong>Nama Anak:</strong> {{ $child->full_name }}</p>
                    <p><strong>Nama Ayah:</strong> {{ $child->father_name }}</p>
                    <p><strong>Nama Ibu:</strong> {{ $child->mother_name }}</p>
                    <p><strong>Status Stunting:</strong> {{ optional($child->stuntingCheck)->stunting_status ?? 'N/A' }}</p>
                    <p><strong>Gejala:</strong>
                        @foreach($child->stuntingCheck->symptoms as $symptom)
                            {{ $symptom->name }},
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
