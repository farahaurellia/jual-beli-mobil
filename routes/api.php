<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    // Hapus atau sesuaikan resource lain jika tidak perlu
    // Route::resource('/posts', \App\Http\Controllers\Api\PostController::class);

    // Semua endpoint produk hanya bisa diakses jika sudah login
    Route::apiResource('products', \App\Http\Controllers\Api\ProductController::class);

    Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class);

    Route::apiResource('customers', \App\Http\Controllers\Api\CustomerController::class);

    Route::apiResource('transactions', \App\Http\Controllers\Api\TransactionController::class);
});
