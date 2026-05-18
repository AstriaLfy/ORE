<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;

Route::apiResource('transactions', TransactionController::class);
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes - ORE (Online Recommerce Engine)
|--------------------------------------------------------------------------
*/

// =============================================
// AUTH SERVICE - Public (tidak perlu token)
// =============================================
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});

// =============================================
// AUTH SERVICE - Protected (perlu token)
// =============================================
Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me',       [AuthController::class, 'me']);
});

// =============================================
// PRODUCT SERVICE - Public
// =============================================
Route::prefix('products')->group(function () {
    Route::get('/',      [ProductController::class, 'index']);
    Route::get('/{id}',  [ProductController::class, 'show']);
});

// =============================================
// PROFILE SERVICE + PRODUCT SERVICE (Protected)
// =============================================
Route::middleware('auth:api')->group(function () {

    // Profile Service
    Route::prefix('profile')->group(function () {
        Route::get('/',           [ProfileController::class, 'show']);
        Route::put('/',           [ProfileController::class, 'update']);
        Route::put('/password',   [ProfileController::class, 'updatePassword']);
        Route::delete('/',        [ProfileController::class, 'destroy']);
    });

    // Product Service (authenticated actions)
    Route::prefix('products')->group(function () {
        Route::get('/my',        [ProductController::class, 'myProducts']);
        Route::post('/',         [ProductController::class, 'store']);
        Route::put('/{id}',      [ProductController::class, 'update']);
        Route::delete('/{id}',   [ProductController::class, 'destroy']);
    });

});

    // Pastikan prefix auth:api disesuaikan jika nama middleware JWT di projectmu berbeda
    Route::middleware('auth:api')->group(function () {
        
    // Endpoint untuk pembeli melihat riwayat ordernya
    Route::get('/orders', [OrderController::class, 'index']);
    
    // Endpoint untuk membuat order baru (Checkout)
    Route::post('/orders', [OrderController::class, 'store']);
    
    // Endpoint untuk update status (diproses/selesai)
    Route::put('/orders/{id_order}/status', [OrderController::class, 'updateStatus']);
    
});
