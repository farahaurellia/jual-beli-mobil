<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Edit Produk</h1>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                <h3 class="font-bold mb-2">Terjadi kesalahan:</h3>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
            <form method="POST" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi Produk</label>
                        <textarea id="description" name="description" rows="3"
                                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label for="price" class="block text-gray-700 font-medium mb-2">Harga Produk</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                            <input type="number" id="price" name="price" 
                                   value="{{ old('price', $product->price) }}" step="0.01"
                                   class="w-full pl-8 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label for="category_id" class="block text-gray-700 font-medium mb-2">Kategori Produk</label>
                        <select id="category_id" name="category_id"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <a href="{{ route('products.index') }}" 
                           class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                            Update Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>