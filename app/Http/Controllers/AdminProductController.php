<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    /**
     * GET /api/admin/products
     * Admin — lihat SEMUA produk (semua status, semua seller)
     */
    public function index(Request $request)
    {
        $query = Product::with('user:id,name,email');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data'    => $products,
        ]);
    }

    /**
     * PUT /api/admin/products/{id}
     * Admin — update produk milik seller manapun
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric|min:0',
            'stock'       => 'sometimes|required|integer|min:0',
            'category'    => 'nullable|string|max:100',
            'condition'   => 'sometimes|required|in:new,like_new,good,fair,poor',
            'status'      => 'sometimes|required|in:available,sold,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $product->update($request->only(
            'name', 'description', 'price', 'stock', 'category', 'condition', 'status'
        ));

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui oleh admin',
            'data'    => $product->fresh()->load('user:id,name,email'),
        ]);
    }

    /**
     * DELETE /api/admin/products/{id}
     * Admin — hapus produk milik seller manapun
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus oleh admin',
        ]);
    }
}