<!-- resources/views/children/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Anak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Anak</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tinggi Badan</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Berat Badan</th>
                                <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status Stunting</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($children as $child)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $child->full_name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $child->stuntingCheck->height }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $child->stuntingCheck->weight }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $child->stuntingCheck->stunting_status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
