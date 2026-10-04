<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Dikelompokkan per toko — checkout nanti per toko
        $carts = Cart::with('product.store')
            ->where('user_id', Auth::id())
            ->get()
            ->groupBy(fn($c) => $c->product->store_id);

        return view('keranjang', compact('carts'));
    }

    public function tambah(Request $req, Product $product)
    {
        $req->validate(['amount' => 'nullable|integer|min:1']);
        $jumlah = (int) ($req->amount ?? 1);

        if ($product->store->user_id === Auth::id()) {
            return Redirect::back()->with('error', 'Tidak bisa membeli produk toko sendiri.');
        }

        $cart = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
        $baru = ($cart->amount ?? 0) + $jumlah;
        if ($baru > $product->stock) {
            return Redirect::back()->with('error', "Stok {$product->name} tersisa {$product->stock}.");
        }
        $cart->amount = $baru;
        $cart->save();

        return Redirect::back()->with('success', "{$product->name} masuk keranjang!");
    }

    public function ubah(Request $req, Cart $cart)
    {
        abort_unless($cart->user_id === Auth::id(), 403);
        $req->validate(['amount' => 'required|integer|min:1|max:' . $cart->product->stock]);
        $cart->update(['amount' => $req->amount]);

        return Redirect::route('keranjang');
    }

    public function hapus(Cart $cart)
    {
        abort_unless($cart->user_id === Auth::id(), 403);
        $cart->delete();

        return Redirect::back()->with('success', 'Dihapus dari keranjang.');
    }
}
