<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Store;

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

        $store = Store::where('user_id', Auth::id())->first();

        if (Auth::user()->role != 'visitor') {
            $transactions = Transaction::where('store_id', $store->id)->get();

            return view('order.orders', compact('transactions'));
        }

        return view('users.visitor.orders', compact('order'));
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->get();

        if ($cart == null)
            return Redirect::back();

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        $payment = Payment::create([
            'is_transfer' => true,
            'receiver' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'dellivery' => $request->delivery
        ]);

        foreach ($cart as $cart) {

            $product = Product::find($cart->product_id);
            $store = Store::where('id', $product->store_id)->first();

            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);

            Transaction::create([
                'store_id' => $store->id,
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

    public function submitPayment(Request $req, Order $order)
    {
        $file = $req->file('payment_receipt');
        $path = time() . '_' . $order->id . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $order->update([
            'payment_receipt' => $path,
        ]);

        return Redirect::back();
    }

    public function confirmPayment(Order $order)
    {
        $order->update([
            'is_paid' => true,
        ]);

        return Redirect::back();
    }
}
