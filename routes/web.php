<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;

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
    return view('dashboard');
})->name('dashboard');

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
Route::patch('/store/{store}/edit', [StoreController::class, 'updateStore'])->name('update_store');
Route::delete('/store/{store}/delete', [StoreController::class, 'deleteStore'])->name('delete_store');

// Users Route
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/user/{user}', [UserController::class, 'detailUser'])->name('detail_user');
Route::get('/user/{user}/edit', [UserController::class, 'editUser'])->name('edit_user');
Route::delete('/user/{user}/delete', [UserController::class, 'deleteUser'])->name('delete_user');

// Order Route
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/order/create', [OrderController::class, 'create'])->name('create_order');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('detail_order');
Route::delete('/order/{order}/delete', [OrderController::class, 'delete'])->name('delete_order');
Route::post('/order/{order}/pay', [OrderController::class, 'submitPayment'])->name('submit_payment');
Route::post('/order/{order}/confirm', [OrderController::class, 'confirmPayment'])->name('confirm_payment');

// Cart Route
Route::get('/my-cart', [CartController::class, 'showCart'])->name('show_cart');
Route::get('/my-cart/{cart}', [CartController::class, 'index'])->name('cart');
Route::post('/my-cart/{product}', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::delete('/my-cart/{cart}/delete', [CartController::class, 'deleteCart'])->name('delete_cart');

// Payment Route
Route::get('/payment/soon', [TransactionController::class, 'index'])->name('payment');
Route::get('/payment', [TransactionController::class, 'create'])->name('create_payment');
