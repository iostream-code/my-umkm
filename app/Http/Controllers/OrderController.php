<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::all();
        $order = Order::where('user_id', Auth::id())->get();

        if (Auth::user()->role == 'visitor')
            return view('users.visitor.orders', compact('order'));

        return view('order.orders', compact('orders'));
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->get();

        if ($cart == null) {
            return Redirect::back();
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        $payment = Payment::create([
            'is_transfer' => true,
            'receiver' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        foreach ($cart as $cart) {

            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);

            Transaction::create([
                'payment_id' => $payment->id,
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'amount' => $cart->amount,
            ]);

            $cart->delete();
        }
        return Redirect::route('home');
    }

    public function show(Order $order)
    {
        if (Auth::user()->role != 'visitor')
            return view('order.order_detail', compact('order'));
        return view('users.visitor.order_detail', compact('order'));
    }

    public function delete(Order $order)
    {
        $order->delete();

        return Redirect::route('orders');
    }
}
