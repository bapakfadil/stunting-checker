<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulir Data Anak - Langkah 2') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('children.postCreateStepTwo') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="height" class="block text-gray-700 text-sm font-bold mb-2">Tinggi Badan (cm):</label>
                            <input type="number" name="height" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="weight" class="block text-gray-700 text-sm font-bold mb-2">Berat Badan (kg):</label>
                            <input type="number" name="weight" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="is_poor_family" class="block text-gray-700 text-sm font-bold mb-2">Status Keluarga Miskin:</label>
                            <select name="is_poor_family" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="symptoms" class="block text-gray-700 text-sm font-bold mb-2">Gejala:</label>
                            <select id="symptoms" name="symptoms[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple="multiple">
                                @foreach($symptoms as $symptom)
                                    <option value="{{ $symptom->id }}">{{ $symptom->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="selected-symptoms" class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Gejala Terpilih:</label>
                            <ul id="selected-symptom-list" class="list-disc pl-5"></ul>
                        </div>

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

<!-- Tambahkan jQuery DataTable -->
@section('scripts')
<script>
    $(document).ready(function() {
        $('#symptoms').select2({
            placeholder: "Pilih gejala",
            allowClear: true
        });

        $('#symptoms').on('change', function() {
            var selectedSymptoms = $(this).val();
            var symptomList = $('#selected-symptom-list');
            symptomList.empty();

            if (selectedSymptoms && selectedSymptoms.length > 0) {
                selectedSymptoms.forEach(function(symptomId) {
                    var symptomText = $('#symptoms option[value="' + symptomId + '"]').text();
                    symptomList.append('<li>' + symptomText + '</li>');
                });
            }
        });
    });
</script>
@endsection
