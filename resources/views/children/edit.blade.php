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

                        <div>
                            <x-input-label for="full_name" :value="__('Nama Anak')" />
                            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" value="{{ $child->full_name }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="father_name" :value="__('Nama Ayah')" />
                            <x-text-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" value="{{ $child->father_name }}" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="mother_name" :value="__('Nama Ibu')" />
                            <x-text-input id="mother_name" class="block mt-1 w-full" type="text" name="mother_name" value="{{ $child->mother_name }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
