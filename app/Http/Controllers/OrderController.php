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

        return view('order.orders', compact('orders'));
    }

    public function create()
    {
        return view('order.order_create');
    }
}
