<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\TransactionController;

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
// PRODUCT SERVICE - Public
// =============================================
Route::prefix('products')->group(function () {
    Route::get('/',     [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

// =============================================
// PROTECTED ROUTES (Perlu token JWT)
// =============================================
Route::middleware('auth:api')->group(function () {

    // --- Auth Service ---
    Route::prefix('auth')->group(function () {
        Route::post('/logout',  [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/me',       [AuthController::class, 'me']);
    });

    // --- Profile Service ---
    Route::prefix('profile')->group(function () {
        Route::get('/',         [ProfileController::class, 'show']);
        Route::put('/',         [ProfileController::class, 'update']);
        Route::put('/password', [ProfileController::class, 'updatePassword']);
        Route::delete('/',      [ProfileController::class, 'destroy']);
    });

    // --- Product Service (aksi yang butuh login) ---
    Route::prefix('products')->group(function () {
        Route::get('/my',      [ProductController::class, 'myProducts']);
        Route::post('/',       [ProductController::class, 'store']);
        Route::put('/{id}',    [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });

    // --- Order Service ---
    Route::prefix('orders')->group(function () {
        Route::get('/',                    [OrderController::class, 'index']);
        Route::post('/',                   [OrderController::class, 'store']);
        Route::put('/{id_order}/status',   [OrderController::class, 'updateStatus']);
    });

    // --- Transaction Service ---
    Route::apiResource('transactions', TransactionController::class);
});
