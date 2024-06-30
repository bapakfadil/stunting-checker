<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('children.createStepOne') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
                        Tambah Data Diagnosa Baru
                    </a>
                    <table id="children-table" class="min-w-full mt-4 bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200">Nama Anak</th>
                                <th class="py-2 px-4 border-b border-gray-200">Nama Ayah</th>
                                <th class="py-2 px-4 border-b border-gray-200">Nama Ibu</th>
                                <th class="py-2 px-4 border-b border-gray-200">Status Stunting</th>
                                <th class="py-2 px-4 border-b border-gray-200">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($children as $child)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $child->full_name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $child->father_name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">{{ $child->mother_name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">{{ optional($child->stuntingCheck)->stunting_status ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-center">
                                    <button onclick="location.href='{{ route('children.show', $child->id) }}'" class="bg-blue-500 text-white hover:bg-blue-700 py-1 px-2 rounded">Detail</button>
                                    <button onclick="location.href='{{ route('children.edit', $child->id) }}'" class="bg-yellow-500 text-white hover:bg-yellow-700 py-1 px-2 rounded">Edit</button>
                                    <form action="{{ route('children.destroy', $child->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white hover:bg-red-700 py-1 px-2 rounded">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Tambahkan jQuery DataTable -->
@section('scripts')
<script>
    $(document).ready(function() {
        $('#children-table').DataTable();
    });
</script>
@endsection
