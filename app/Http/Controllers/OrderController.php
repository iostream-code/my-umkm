<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;

class OrderController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->get();

        if ($cart == null) {
            return Redirect::back();
        }

        $order = Order::create([
            'user_id' => $user_id,
        ]);

        foreach ($cart as $cart) {

            $product = Product::find($cart->product_id);

            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);

            Transaction::create([
                'amount' => $cart->amount,
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
            ]);

            $cart->delete();
        }
        return Redirect::back();
    }

    public function orders()
    {
        $orders = Order::all();

        return view('orders', compact('orders'));
    }

    public function detailOrder(Order $order)
    {
        return view('order_detail', compact('order'));
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
