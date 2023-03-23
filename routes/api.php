<?php

use App\Http\Controllers\api\Auth\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StatusController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/login',[AuthController::class,'login']);
Route::POST('/register',[AuthController::class,'register']);

// Category Routes
Route::prefix('/categories')->name('categories.')->group(function()
{
    Route::GET('/',[CategoryController::class,'getCategories'])->name('all');
    Route::POST('/',[CategoryController::class,'addCategory'])->name('add');
    Route::PUT('/{id}',[CategoryController::class,'updateCategory'])->name('update');
    Route::DELETE('/{id}',[CategoryController::class,'deleteCategory'])->name('delete');
});

// Product Routes

Route::prefix('/products')->name('products.')->group(function()
{
    Route::GET('/',[ProductController::class,'getProducts'])->name('all');
    Route::GET('/{id}',[ProductController::class,'getProduct'])->name('single');
    Route::POST('/',[ProductController::class,'addProduct'])->name('add');
    Route::PUT('/{id}',[ProductController::class,'updateProduct'])->name('update');
    Route::DELETE('/{id}',[ProductController::class,'deleteProduct'])->name('delete');
});

Route::prefix('/cart')->name('cart.')->group(function()
{
    Route::GET('/{user_id}',[CartController::class,'getCart'])->name('all');
    Route::POST('/add',[CartController::class,'addToCart'])->name('add');
    Route::PUT('/update/{user_id}',[CartController::class,'updateCart'])->name('update');
    Route::DELETE('/delete/{user_id}',[CartController::class,'removeFromCart'])->name('delete');

});
Route::prefix('/statuses')->name('statuses.')->group(function()
{
    Route::GET('/',[StatusController::class,'getStatuses'])->name('all');
});
