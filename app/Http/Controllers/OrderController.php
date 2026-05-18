<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Menampilkan riwayat order untuk user yang sedang login (Pembeli)
     */
    public function index()
    {
        // Mendapatkan user ID dari token JWT
        $userId = Auth::id(); 
        
        $orders = Order::where('user_id', $userId)->get();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat order berhasil diambil',
            'data' => $orders
        ], 200);
    }

    /**
     * Membuat order baru saat user klik beli
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|integer'
        ]);

        $userId = Auth::id();

        // Menyimpan data pembelian
        $order = Order::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
            'tanggal' => Carbon::now(),
            'status' => 'pending' // Status default sesuai alur
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dibuat, silakan lanjut ke pembayaran',
            'data' => $order
        ], 201);
    }

    /**
     * Mengupdate status order 
     * (Biasanya endpoint ini di-hit oleh Transaction Service setelah pembayaran berhasil/gagal)
     */
    public function updateStatus(Request $request, $id_order)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai'
        ]);

        $order = Order::find($id_order);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status order berhasil diperbarui',
            'data' => $order
        ], 200);
    }
}