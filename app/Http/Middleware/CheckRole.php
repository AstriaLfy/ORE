<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated.',
            ], 401);
        }

        if (!in_array(auth()->user()->role, $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Role kamu tidak memiliki izin untuk aksi ini.',
            ], 403);
        }

        return $next($request);
    }
}