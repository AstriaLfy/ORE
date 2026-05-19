<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * GET /api/admin/users
     * Admin — lihat semua user
     */
    public function index(Request $request)
    {
        $query = User::withCount('products');

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data'    => $users,
        ]);
    }

    /**
     * GET /api/admin/users/{id}
     * Admin — detail satu user beserta produknya
     */
    public function show($id)
    {
        $user = User::withCount('products')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $user,
        ]);
    }

    /**
     * DELETE /api/admin/users/{id}
     * Admin — hapus akun user lain (tidak bisa hapus diri sendiri)
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak bisa menghapus akun sendiri melalui endpoint ini.',
            ], 400);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akun user berhasil dihapus',
        ]);
    }
}