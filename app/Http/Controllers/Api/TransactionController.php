<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    // Tampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::with(['customer', 'product'])->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
        ]);

        // Ambil harga produk dari database
        $product = Product::findOrFail($validated['product_id']);
        $price = $product->price;
        $total_price = $price * $validated['amount'];

        // Simpan transaksi
        $transaction = Transaction::create([
            'customer_id' => $validated['customer_id'],
            'product_id' => $validated['product_id'],
            'amount' => $validated['amount'],
            'price' => $price,
            'total_price' => $total_price,
            'transaction_date' => $validated['transaction_date'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil ditambahkan',
            'data' => $transaction
        ], 201);
    }

    // Tampilkan detail transaksi
    public function show($id)
    {
        $transaction = Transaction::with(['customer', 'product'])->find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    // Update transaksi
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
        ]);

        // Ambil harga produk dari database
        $product = Product::findOrFail($validated['product_id']);
        $price = $product->price;
        $total_price = $price * $validated['amount'];

        $transaction->update([
            'customer_id' => $validated['customer_id'],
            'product_id' => $validated['product_id'],
            'amount' => $validated['amount'],
            'price' => $price,
            'total_price' => $total_price,
            'transaction_date' => $validated['transaction_date'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil diupdate',
            'data' => $transaction
        ]);
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }
}