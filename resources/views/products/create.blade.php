<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h1>
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

        <form method="POST" action="{{ route('products.store') }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi Produk</label>
                <textarea id="description" name="description" 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="price" class="block text-gray-700 font-medium mb-2">Harga Produk</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01"
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori Produk</label>
                <select id="category_id" name="category_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>