<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\VariantController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('category', CategoryController::class);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{category:slug}', [CategoryController::class, 'show']);

Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/variant', [VariantController::class, 'index']);
Route::get('/variant/{variant:slug}', [VariantController::class, 'show']);

Route::get('/attribute', [AttributeController::class, 'index']);
Route::get('/attribute/{attribute:slug}', [AttributeController::class, 'show']);


Route::prefix('order')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{order:number}', [OrderController::class, 'show']);
    Route::post('/', [OrderController::class, 'store']);
    // Route::put('/{orderId}', [OrderController::class, 'show']);
    Route::get('/customer/{id}', [OrderController::class, 'getOrdersByCustomer']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
