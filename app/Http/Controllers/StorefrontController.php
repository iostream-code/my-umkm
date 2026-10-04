<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    /** Beranda = etalase: pencarian, kategori, produk. Tanpa basa-basi. */
    public function beranda(Request $req)
    {
        $products = Product::with('store')
            ->where('stock', '>', 0)
            ->when($req->filled('q'), fn($q) =>
                $q->where(fn($w) => $w
                    ->where('name', 'like', '%' . $req->q . '%')
                    ->orWhere('description', 'like', '%' . $req->q . '%')))
            ->when($req->filled('kategori'), fn($q) => $q->where('category', $req->kategori))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('beranda', compact('products'));
    }

    public function produk(Product $product)
    {
        $product->load('store');
        $lainnya = Product::where('store_id', $product->store_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->take(4)->get();

        return view('produk', compact('product', 'lainnya'));
    }

    public function toko(Store $store)
    {
        $products = $store->products()->latest()->paginate(12);
        return view('toko', compact('store', 'products'));
    }

    public function daftarToko()
    {
        $stores = Store::withCount('products')->latest()->paginate(12);
        return view('daftar_toko', compact('stores'));
    }
}
