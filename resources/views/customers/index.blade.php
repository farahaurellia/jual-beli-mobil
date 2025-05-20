<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Pelanggan</h1>
            <a href="{{ route('customers.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                Tambah Pelanggan Baru
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm">
                            <th class="px-5 py-3 border-b-2 border-gray-200">Nama</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Email</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Telepon</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Alamat</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 border-b border-gray-200">{{ $customer->name }}</td>
                            <td class="px-5 py-4 border-b border-gray-200 text-gray-600">{{ $customer->email }}</td>
                            <td class="px-5 py-4 border-b border-gray-200">{{ $customer->phone }}</td>
                            <td class="px-5 py-4 border-b border-gray-200">{{ Str::limit($customer->address, 30) }}</td>
                            <td class="px-5 py-4 border-b border-gray-200">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('customers.edit', $customer->id) }}" 
                                       class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>