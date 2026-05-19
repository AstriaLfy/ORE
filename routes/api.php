<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Api\TransactionController;

/*

|--------------------------------------------------------------------------
| API Routes - ORE (Online Recommerce Engine)
|--------------------------------------------------------------------------
|
| Role hierarchy:
|   admin  → full access
|   seller → manage own products
|   buyer  → read only
|
*/
 
// =============================================
// AUTH — Public
// =============================================
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);
});
 
// =============================================
// AUTH — Protected (semua role)
// =============================================
Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me',       [AuthController::class, 'me']);
});
 
// =============================================
// PRODUCT — Public (tanpa login)
// =============================================
Route::prefix('products')->group(function () {
    Route::get('/',     [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});
 
// =============================================
// PROFILE — Protected (semua role)
// =============================================
Route::prefix('profile')->middleware('auth:api')->group(function () {
    Route::get('/',         [ProfileController::class, 'show']);
    Route::put('/',         [ProfileController::class, 'update']);
    Route::put('/password', [ProfileController::class, 'updatePassword']);
    Route::delete('/',      [ProfileController::class, 'destroy']);
});
 
// =============================================
// PRODUCT — Seller & Admin only
// (buyer tidak bisa POST/PUT/DELETE produk)
// =============================================
Route::prefix('products')->middleware(['auth:api', 'role:seller,admin'])->group(function () {
    Route::get('/my',     [ProductController::class, 'myProducts']);
    Route::post('/',      [ProductController::class, 'store']);
    Route::put('/{id}',   [ProductController::class, 'update']);
    Route::delete('/{id}',[ProductController::class, 'destroy']);
});
 
// =============================================
// ADMIN — Admin only
// =============================================
Route::prefix('admin')->middleware(['auth:api', 'role:admin'])->group(function () {
 
    // Kelola semua user
    Route::get('/users',        [AdminUserController::class, 'index']);
    Route::get('/users/{id}',   [AdminUserController::class, 'show']);
    Route::delete('/users/{id}',[AdminUserController::class, 'destroy']);
 
    // Kelola semua produk (termasuk milik seller lain)
    Route::get('/products',         [AdminProductController::class, 'index']);
    Route::put('/products/{id}',    [AdminProductController::class, 'update']);
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy']);
 
    // --- Order Service ---
    Route::prefix('orders')->group(function () {
        Route::get('/',                    [OrderController::class, 'index']);
        Route::post('/',                   [OrderController::class, 'store']);
        Route::put('/{id_order}/status',   [OrderController::class, 'updateStatus']);
    });

    // --- Transaction Service ---
    Route::apiResource('transactions', TransactionController::class);
});
