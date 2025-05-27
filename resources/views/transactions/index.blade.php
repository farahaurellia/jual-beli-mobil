<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h1>
            <a href="{{ route('transactions.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                Tambah Transaksi Baru
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
                            <th class="px-5 py-3 border-b-2 border-gray-200">ID</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Pelanggan</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Produk</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Jumlah</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Harga /Barang</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Total Harga</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200">Tanggal</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 border-b border-gray-200">#{{ $transaction->id }}</td>
                            <td class="px-5 py-4 border-b border-gray-200">
                                {{ $transaction->customer->name }}
                                <div class="text-xs text-gray-500">{{ $transaction->customer->email }}</div>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200">
                                {{ $transaction->product->name }}
                                <div class="text-xs text-gray-500">{{ $transaction->product->category->name ?? '-' }}</div>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 font-medium">
                                {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 font-medium">
                                Rp {{ number_format($transaction->price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 font-medium">
                                Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200">
                                {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" 
                                       class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-4 text-center text-gray-500">
                                Tidak ada data transaksi
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>