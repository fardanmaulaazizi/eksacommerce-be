<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(
//     function () {
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class)->except(['index', 'put']);
Route::post('products/{product}', [ProductController::class, 'update']);
Route::resource('reviews', ReviewController::class);
Route::resource('stores', StoreController::class);
Route::post('store/register', [StoreController::class, 'register']);
Route::get('store/user/{user}', [StoreController::class, 'getStoreByUserId']);

Route::resource('users', UserController::class);
Route::resource('transactions', TransactionController::class);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/category/{category}', [ProductController::class, 'productByCategory']);
Route::get('/transactions/store/{store}', [TransactionController::class, 'getTransactionStoreById']);
Route::post('/transactions/{transaction}/deliver', [TransactionController::class, 'deliverItems']);
Route::get('/transactions/user/{user}', [TransactionController::class, 'getTransactionByUserId']);

Route::get('/reviews/store/{store}', [ReviewController::class, 'reviewByStoreId']);
Route::post('token-midtrans', [MidtransController::class, 'getToken']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/update-account/{user}', [AuthController::class, 'updateAccount']);
