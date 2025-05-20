<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Edit Pelanggan</h1>
            <a href="{{ route('customers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                Kembali
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
            <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Pelanggan</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email Pelanggan</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="phone" class="block text-gray-700 font-medium mb-2">No. Telp Pelanggan</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="address" class="block text-gray-700 font-medium mb-2">Alamat Pelanggan</label>
                        <textarea id="address" name="address" rows="3"
                                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  required>{{ old('address', $customer->address) }}</textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('customers.index') }}" 
                           class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                            Update Pelanggan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>