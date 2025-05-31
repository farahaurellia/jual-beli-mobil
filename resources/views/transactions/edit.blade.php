<x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Edit Transaksi #{{ $transaction->id }}</h1>
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
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
            <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_id" class="block text-gray-700 font-medium mb-2">Pelanggan</label>
                        <select id="customer_id" name="customer_id" required
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" 
                                    {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="product_id" class="block text-gray-700 font-medium mb-2">Produk</label>
                        <select id="product_id" name="product_id" required
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" 
                                    {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}
                                    data-price="{{ $product->price }}">
                                    {{ $product->name }} (Rp {{ number_format($product->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="amount" class="block text-gray-700 font-medium mb-2">Jumlah Barang</label>
                        <div class="relative">
                            <input type="number" id="amount" name="amount" 
                                   value="{{ old('amount', $transaction->amount) }}" step="0.01" 
                                   class="w-full  px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label for="price" class="block text-gray-700 font-medium mb-2">Harga /Barang</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                            <input type="number" id="price" name="price" 
                                   value="{{ old('price', $transaction->price) }}" step="0.01" 
                                   class="w-full pl-8 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   readonly required>
                        </div>
                    </div>

                    <div>
                        <label for="total_price" class="block text-gray-700 font-medium mb-2">Total Harga</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                            <input type="number" id="total_price" name="total_price" 
                                   value="{{ old('total_price', $transaction->total_price) }}" step="0.01" min="0"
                                   class="w-full pl-8 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   readonly required>
                        </div>
                    </div>

                    <div>
                        <label for="transaction_date" class="block text-gray-700 font-medium mb-2">Tanggal Transaksi</label>
                        <input type="date" id="transaction_date" name="transaction_date" 
                               value="{{ old('transaction_date', $transaction->transaction_date) }}"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               readonly required>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('transactions.index') }}" 
                       class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                        Update Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

        <script>
document.addEventListener('DOMContentLoaded', function () {
    const productSelect = document.getElementById('product_id');
    const priceInput = document.getElementById('price');
    const amountInput = document.getElementById('amount');
    const totalInput = document.getElementById('total_price');

    function updateTotal() {
        const price = parseFloat(priceInput.value) || 0;
        const amount = parseFloat(amountInput.value) || 0;
        const total = price * amount;
        totalInput.value = total.toFixed(2);
    }

    productSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        priceInput.value = parseFloat(price || 0).toFixed(2);
        updateTotal(); 
    });

    amountInput.addEventListener('input', updateTotal);
});
</script>
</x-layouts.app>