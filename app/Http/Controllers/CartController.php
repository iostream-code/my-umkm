<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();

        return view('cart.cart', compact('carts'));
    }

    public function addToCart(Product $product, Request $request)
    {
        $user_id = Auth::id();
        $product_id = $product->id;

        $existing_cart = Cart::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existing_cart == null) {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . $product->stock
            ]);

            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'amount' => $request->amount,
            ]);
        }

        $carts = Cart::where('user_id', Auth::id())->get();

        return view('cart.cart', compact('carts'));
    }

    public function showCart()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        return view('cart.cart', compact('carts'));
    }

    public function deleteCart(Cart $cart)
    {
        $cart->delete();

        return Redirect::route('stores');
    }
}
