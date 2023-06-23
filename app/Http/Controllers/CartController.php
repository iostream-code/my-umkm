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
    public function addToCart(Product $product, Request $request)
    {
        $user_id = Auth::id();
        $product_id = $product->id;

        $existing_cart = Cart::where('store_id', $product->store_id)
            ->where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existing_cart == '') {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . $product->stock
            ]);

            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'store_id' => $product->store_id,
                'amount' => $request->amount,
            ]);
        } else {
            $request->validate([
                'amount' => 'required|gte:1|lte:' . ($product->stock - $existing_cart->amount)
            ]);

            $existing_cart->update([
                'amount' => $existing_cart->amount + $request->ampunt
            ]);
        }

        return Redirect::route('cart');
    }

    public function showCart()
    {
        $user_id = Auth::id();
        $carts =  Cart::where('user_id', $user_id)->get();

        return view('cart.cart', compact('carts'));
    }

    public function deleteCart(Cart $cart)
    {
        $cart->delete();

        return Redirect::route('home');
    }

    public function payment(Cart $cart)
    {
        return view('cart.payment', compact('cart'));
    }

    public function checkout(Request $request)
    {
        Payment::create([
            'is_transfer' => $request->payment_method,
            'receiver' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone
        ]);

        return Redirect::route('home');
    }
}
