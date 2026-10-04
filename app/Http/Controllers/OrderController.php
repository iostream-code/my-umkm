<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Support\Webp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Form checkout untuk SATU toko (keranjang dipecah per toko). */
    public function checkoutForm(Request $req)
    {
        $storeId = (int) $req->query('toko');
        $carts = Cart::with('product.store')
            ->where('user_id', Auth::id())
            ->whereHas('product', fn($q) => $q->where('store_id', $storeId))
            ->get();

        if ($carts->isEmpty()) {
            return Redirect::route('keranjang')->with('error', 'Tidak ada barang dari toko ini di keranjang.');
        }

        $store = $carts->first()->product->store;
        $total = $carts->sum(fn($c) => $c->amount * $c->product->price);

        return view('checkout', compact('carts', 'store', 'total'));
    }

    public function checkout(Request $req)
    {
        $data = $req->validate([
            'store_id' => 'required|exists:stores,id',
            'recipient_name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:1000',
        ]);

        $order = DB::transaction(function () use ($data) {
            $carts = Cart::with('product')
                ->where('user_id', Auth::id())
                ->whereHas('product', fn($q) => $q->where('store_id', $data['store_id']))
                ->lockForUpdate()
                ->get();

            if ($carts->isEmpty()) {
                throw ValidationException::withMessages(['cart' => 'Keranjang untuk toko ini kosong.']);
            }

            $total = 0;
            foreach ($carts as $cart) {
                $product = Product::whereKey($cart->product_id)->lockForUpdate()->first();
                if ($product->stock < $cart->amount) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok {$product->name} tersisa {$product->stock}.",
                    ]);
                }
                $total += $cart->amount * $product->price;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'store_id' => $data['store_id'],
                'status' => 'menunggu_pembayaran',
                'total' => $total,
                'recipient_name' => $data['recipient_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
            ]);

            foreach ($carts as $cart) {
                $cart->product->decrement('stock', $cart->amount);
                Transaction::create([
                    'order_id' => $order->id,
                    'store_id' => $data['store_id'],
                    'product_id' => $cart->product_id,
                    'amount' => $cart->amount,
                    'price' => $cart->product->price,
                ]);
                $cart->delete();
            }

            return $order;
        });

        return Redirect::route('detail_pesanan', $order)
            ->with('success', 'Pesanan dibuat! Silakan transfer dan unggah bukti pembayaran.');
    }

    public function index()
    {
        $orders = Order::with('store')->withCount('transactions')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pesanan', compact('orders'));
    }

    public function show(Order $order)
    {
        $pemilikToko = $order->store && $order->store->user_id === Auth::id();
        abort_unless($order->user_id === Auth::id() || $pemilikToko, 403);
        $order->load('transactions.product', 'store');

        return view('pesanan_detail', compact('order'));
    }

    /** Upload bukti transfer (dikonversi WebP, disk privat). */
    public function kirimBukti(Request $req, Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        abort_unless($order->status === 'menunggu_pembayaran', 422);

        $req->validate(['payment_receipt' => 'required|image|max:4096']);

        $path = Webp::simpan($req->file('payment_receipt'), 'bukti-bayar', disk: 'local', maxLebar: 1200);
        $order->update([
            'payment_receipt' => $path,
            'status' => 'menunggu_konfirmasi',
        ]);

        return Redirect::back()->with('success', 'Bukti terkirim! Tunggu konfirmasi penjual ya.');
    }

    /** Tampilkan bukti: pembeli ybs atau pemilik toko. */
    public function bukti(Order $order)
    {
        $pemilikToko = $order->store && $order->store->user_id === Auth::id();
        abort_unless($order->user_id === Auth::id() || $pemilikToko, 403);
        abort_unless($order->payment_receipt, 404);

        foreach (['local', 'public'] as $disk) {
            if (Storage::disk($disk)->exists($order->payment_receipt)) {
                return Storage::disk($disk)->response($order->payment_receipt);
            }
        }
        abort(404);
    }
}
