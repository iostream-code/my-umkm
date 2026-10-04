<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Support\Webp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

/** "Toko Saya" — semua urusan penjual dalam satu tempat sederhana. */
class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function tokoSaya(): ?Store
    {
        return Auth::user()->store;
    }

    // ---------- BUKA TOKO ----------
    public function formBuka()
    {
        if ($this->tokoSaya()) {
            return Redirect::route('toko_saya');
        }
        return view('seller.buka_toko');
    }

    public function buka(Request $req)
    {
        if ($this->tokoSaya()) {
            return Redirect::route('toko_saya');
        }

        $data = $req->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:stores,email',
            'location' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'bank' => 'required|string|max:50',
            'no_rek' => 'required|string|max:50',
            'picture' => 'nullable|image|max:4096',
        ]);

        $data['user_id'] = Auth::id();
        if ($req->hasFile('picture')) {
            $data['picture'] = Webp::simpan($req->file('picture'), 'toko');
        }
        $store = Store::create($data);

        return Redirect::route('toko_saya')->with('success', "Selamat! Toko {$store->name} resmi buka 🎉");
    }

    // ---------- DASBOR TOKO ----------
    public function index()
    {
        $store = $this->tokoSaya();
        if (!$store) {
            return Redirect::route('buka_toko');
        }

        $stats = [
            'produk' => $store->products()->count(),
            'perlu_konfirmasi' => $store->orders()->where('status', 'menunggu_konfirmasi')->count(),
            'penjualan' => $store->orders()->whereIn('status', ['diproses', 'dikirim', 'selesai'])->sum('total'),
        ];
        $pesananMasuk = $store->orders()->with('user')
            ->whereIn('status', ['menunggu_konfirmasi', 'diproses', 'dikirim'])
            ->latest()->take(8)->get();
        $products = $store->products()->latest()->paginate(10);

        return view('seller.toko_saya', compact('store', 'stats', 'pesananMasuk', 'products'));
    }

    public function updateToko(Request $req)
    {
        $store = $this->tokoSaya() ?? abort(404);

        $data = $req->validate([
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'bank' => 'required|string|max:50',
            'no_rek' => 'required|string|max:50',
            'picture' => 'nullable|image|max:4096',
        ]);
        if ($req->hasFile('picture')) {
            $data['picture'] = Webp::simpan($req->file('picture'), 'toko');
        }
        $store->update($data);

        return Redirect::route('toko_saya')->with('success', 'Profil toko disimpan.');
    }

    // ---------- PRODUK ----------
    public function formProduk(?Product $product = null)
    {
        $store = $this->tokoSaya() ?? abort(404);
        if ($product && $product->store_id !== $store->id) {
            abort(403);
        }

        return view('seller.produk_form', [
            'product' => $product ?? new Product(),
        ]);
    }

    public function simpanProduk(Request $req, ?Product $product = null)
    {
        $store = $this->tokoSaya() ?? abort(404);
        if ($product && $product->store_id !== $store->id) {
            abort(403);
        }

        $data = $req->validate([
            'name' => 'required|string|max:150',
            'category' => 'required|in:' . implode(',', Product::KATEGORI),
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'image' => ($product ? 'nullable' : 'required') . '|image|max:4096',
        ]);

        if ($req->hasFile('image')) {
            if ($product?->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = Webp::simpan($req->file('image'), 'produk');
        }

        if ($product) {
            $product->update($data);
        } else {
            $data['store_id'] = $store->id;
            Product::create($data);
        }

        return Redirect::route('toko_saya')->with('success', 'Produk disimpan.');
    }

    public function hapusProduk(Product $product)
    {
        $store = $this->tokoSaya() ?? abort(404);
        abort_unless($product->store_id === $store->id, 403);

        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return Redirect::back()->with('success', 'Produk dihapus.');
    }

    // ---------- PESANAN MASUK ----------
    public function pesanan(Request $req)
    {
        $store = $this->tokoSaya() ?? abort(404);
        $orders = $store->orders()->with('user')->withCount('transactions')
            ->when($req->filled('status'), fn($q) => $q->where('status', $req->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('seller.pesanan_masuk', compact('store', 'orders'));
    }

    public function ubahStatus(Request $req, Order $order)
    {
        $store = $this->tokoSaya() ?? abort(404);
        abort_unless($order->store_id === $store->id, 403);

        $req->validate(['status' => 'required|in:' . implode(',', array_keys(Order::STATUS))]);

        $order->update([
            'status' => $req->status,
            'is_paid' => in_array($req->status, ['diproses', 'dikirim', 'selesai'], true),
        ]);

        return Redirect::back()->with('success', 'Status pesanan diperbarui.');
    }
}
