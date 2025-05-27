<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Tambah Customer Baru</h1>
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

        <form method="POST" action="{{ route('customers.store') }}" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Pelanggan</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email Pelanggan</label>
                <input id="email" name="email" type="email"
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                          required>{{ old('email') }}</input>
            </div>

            <div class="mb-6">
                <label for="phone" class="block text-gray-700 font-medium mb-2">No. Telp Pelanggan</label>
                <div class="relative">
                    <input type="number" id="phone" name="phone" value="{{ old('phone') }}" 
                           class="w-full pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            minlength="10" required>
                </div>
            </div>

            <div class="mb-6">
                <label for="address" class="block text-gray-700 font-medium mb-2">Alamat Pelanggan</label>
                <div class="relative">
                    <input type="text" id="address" name="address" value="{{ old('address') }}" 
                           class="w-full pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                </div>
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