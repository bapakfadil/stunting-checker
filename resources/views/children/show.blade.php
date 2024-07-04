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
                    <h3 class="text-lg font-bold text-center mb-4">Detail Anak</h3>
                    <table class="min-w-full bg-white">
                        <tbody>
                            <tr>
                                <td class="border px-3 py-2 font-bold">Nama Anak</td>
                                <td class="border px-4 py-2">{{ $child->full_name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 font-bold">Nama Ayah</td>
                                <td class="border px-4 py-2">{{ $child->father_name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 font-bold">Nama Ibu</td>
                                <td class="border px-4 py-2">{{ $child->mother_name }}</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 font-bold">Gejala</td>
                                <td class="border px-4 py-2">
                                    @foreach($child->stuntingCheck->symptoms as $symptom)
                                        {{ $symptom->name }}{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2 font-bold">Status Stunting</td>
                                <td class="border px-4 py-2">{{ optional($child->stuntingCheck)->stunting_status ?? 'N/A' }}</td>
                            </tr>
                            @if($disease)
                                <tr>
                                    <td class="border px-4 py-2 font-bold">Penjelasan</td>
                                    <td class="border px-4 py-2">{{ $disease->description }}</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2 font-bold">Solusi</td>
                                    <td class="border px-4 py-2">{{ $disease->solution }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
