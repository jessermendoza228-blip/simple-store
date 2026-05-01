<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;

// 🔓 PUBLIC ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/products',           [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// 🔒 PROTECTED ROUTES
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',        [AuthController::class, 'logout']);
    Route::get('/user',           fn(Request $request) => $request->user());
    Route::get('/orders',         [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
});


    
