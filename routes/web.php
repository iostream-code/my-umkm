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

// Store Route
Route::get('/stores', [StoreController::class, 'stores'])->name('stores');
Route::get('/store/create', [StoreController::class, 'createStore'])->name('create_store');
Route::post('/store/regist', [StoreController::class, 'registStore'])->name('regist_store');
Route::get('/store/{store}', [StoreController::class, 'detailStore'])->name('detail_store');
Route::delete('/store/{store}/delete', [StoreController::class, 'deleteStore'])->name('delete_store');
Route::get('/store/edit/{store}', [StoreController::class, 'editStore'])->name('edit_store');
Route::patch('/store/edit/{store}/update', [StoreController::class, 'updateStore'])->name('update_store');

// Users Route
Route::get('/users', [UserController::class, 'users'])->name('users');