<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ---------- Etalase (publik) ----------
Route::get('/', [StorefrontController::class, 'beranda'])->name('beranda');
Route::get('/produk/{product:slug}', [StorefrontController::class, 'produk'])->name('detail_produk');
Route::get('/toko', [StorefrontController::class, 'daftarToko'])->name('daftar_toko');
Route::get('/toko/{store:slug}', [StorefrontController::class, 'toko'])->name('detail_toko');

Auth::routes();
Route::get('/home', fn() => redirect()->route('beranda'))->name('home');

// ---------- Pembeli ----------
Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/{product:slug}', [CartController::class, 'tambah'])->name('tambah_keranjang');
    Route::patch('/keranjang/{cart}', [CartController::class, 'ubah'])->name('ubah_keranjang');
    Route::delete('/keranjang/{cart}', [CartController::class, 'hapus'])->name('hapus_keranjang');

    Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkout_form');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
    Route::get('/pesanan/{order}', [OrderController::class, 'show'])->name('detail_pesanan');
    Route::post('/pesanan/{order}/bayar', [OrderController::class, 'kirimBukti'])->name('kirim_bukti');
    Route::get('/pesanan/{order}/bukti', [OrderController::class, 'bukti'])->name('bukti_bayar');

    // ---------- Penjual (Toko Saya) ----------
    Route::get('/buka-toko', [SellerController::class, 'formBuka'])->name('buka_toko');
    Route::post('/buka-toko', [SellerController::class, 'buka'])->name('buka_toko_simpan');
    Route::get('/toko-saya', [SellerController::class, 'index'])->name('toko_saya');
    Route::patch('/toko-saya', [SellerController::class, 'updateToko'])->name('update_toko');
    Route::get('/toko-saya/produk/tambah', [SellerController::class, 'formProduk'])->name('produk_tambah');
    Route::post('/toko-saya/produk', [SellerController::class, 'simpanProduk'])->name('produk_simpan');
    Route::get('/toko-saya/produk/{product:slug}/edit', [SellerController::class, 'formProduk'])->name('produk_edit');
    Route::patch('/toko-saya/produk/{product:slug}', [SellerController::class, 'simpanProduk'])->name('produk_update');
    Route::delete('/toko-saya/produk/{product:slug}', [SellerController::class, 'hapusProduk'])->name('produk_hapus');
    Route::get('/toko-saya/pesanan', [SellerController::class, 'pesanan'])->name('pesanan_masuk');
    Route::patch('/toko-saya/pesanan/{order}', [SellerController::class, 'ubahStatus'])->name('ubah_status_pesanan');
});
