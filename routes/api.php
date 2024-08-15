<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
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

Route::post('sign-up',[AuthController::class, 'signUp'])->name('api.sign-up');
Route::post('login',[AuthController::class, 'login'])->name('api.login');

Route::middleware(['auth:api'])->group(function () {
    
    Route::get('products',[ProductController::class, 'productList'])->name('api.products');
    Route::get('product-details/{id?}',[ProductController::class, 'productDetails'])->name('api.product-details');
    Route::get('product-search/{search?}',[ProductController::class, 'productSearch'])->name('api.product-search');
    
    Route::get('logout',[AuthController::class, 'logOut'])->name('api.logout');
});
