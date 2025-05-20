<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Tambah Kategori Baru</h1>
            </div>
        </x-slot>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                <h3 class="font-bold mb-2">Ada kesalahan dalam pengisian form:</h3>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('categories.store') }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Kategori</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <input id="description" name="description" type="text"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('description') }}</input>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>