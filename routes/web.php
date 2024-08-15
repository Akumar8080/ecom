<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('/');

Route::get('/product-list', function () {
    return view('productlist');
})->name('product-list');

Route::get('/product/{id?}', function () {
    return view('productdetail');
})->name('product');

Route::get('/register', function () {
    return view('register');
})->name('register');

