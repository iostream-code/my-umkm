<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product Route
Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/store/{store}/product/create', [ProductController::class, 'createProduct'])->name('create_product');
Route::post('/store/{store}/product/regist', [ProductController::class, 'registProduct'])->name('regist_product');
Route::get('/product/{product}', [ProductController::class, 'detailProduct'])->name('detail_product');
Route::get('/product/{product}/edit', [ProductController::class, 'editProduct'])->name('edit_product');
Route::patch('/product/{product}/edit/update', [ProductController::class, 'updateProduct'])->name('update_product');
Route::delete('/product/{product}/delete', [ProductController::class, 'deleteProduct'])->name('delete_product');

// Store Route
Route::get('/stores', [StoreController::class, 'stores'])->name('stores');
Route::get('/store/create', [StoreController::class, 'createStore'])->name('create_store');
Route::post('/store/regist', [StoreController::class, 'registStore'])->name('regist_store');
Route::get('/store/{store}', [StoreController::class, 'detailStore'])->name('detail_store');
Route::get('/store/{store}/edit', [StoreController::class, 'editStore'])->name('edit_store');
Route::patch('/store/{store}/edit/update', [StoreController::class, 'updateStore'])->name('update_store');
Route::delete('/store/{store}/delete', [StoreController::class, 'deleteStore'])->name('delete_store');

// Users Route
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/user/{user}', [UserController::class, 'detailUser'])->name('detail_user');
