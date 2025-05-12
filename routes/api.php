<?php

use App\Http\Controllers\Auth\JwtAuthController;
use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [JwtAuthController::class, 'register']);
Route::post('/login', [JwtAuthController::class, 'login']);

Route::middleware(['jwt', 'throttle:10,1'])->prefix('auth')->group(function () {
    Route::get('/user', [JwtAuthController::class, 'getUser']);
    Route::post('/logout', [JwtAuthController::class, 'logout']);
    Route::put('/update-user', [JwtAuthController::class, 'updateUser']);
});

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products/store', [ProductController::class, 'store']);
Route::get('/product/show/{id}', [ProductController::class, 'show']);
Route::put('/product/{id}/update', [ProductController::class, 'update']);
