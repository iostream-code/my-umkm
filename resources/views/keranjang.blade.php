@extends('layouts.app')

@section('title', 'Keranjang — MyUMKM')

@section('content')
<div class="container" style="max-width: 820px">
    <h1 class="h3 fw-bolder mb-4"><i class="bi bi-cart3 me-1 text-um"></i>Keranjang Belanja</h1>

    @if ($carts->isEmpty())
        <div class="card p-5 text-center text-muted">
            <i class="bi bi-cart-x fs-1"></i>
            <p class="mt-2">Keranjang masih kosong nih.</p>
            <a href="{{ route('beranda') }}" class="btn btn-um mx-auto px-4">Yuk Belanja</a>
        </div>
    @else
        @foreach ($carts as $storeId => $items)
            @php($store = $items->first()->product->store)
            @php($subtotal = $items->sum(fn($c) => $c->amount * $c->product->price))
            <div class="card p-3 p-md-4 mb-4">
                <div class="d-flex align-items-center gap-2 border-bottom pb-2 mb-3">
                    <i class="bi bi-shop text-um"></i>
                    <a href="{{ route('detail_toko', $store) }}" class="fw-bolder text-dark text-decoration-none">{{ $store->name }}</a>
                </div>

                @foreach ($items as $cart)
                    <div class="row g-2 align-items-center mb-3">
                        <div class="col-3 col-md-2">
                            <img src="{{ $cart->product->image_url }}" class="w-100 rounded-3"
                                style="aspect-ratio:1;object-fit:cover" alt="">
                        </div>
                        <div class="col-9 col-md-4">
                            <p class="fw-bold mb-0 lh-sm">{{ $cart->product->name }}</p>
                            <small class="text-muted">Rp{{ number_format($cart->product->price, 0, ',', '.') }}</small>
                        </div>
                        <div class="col-6 col-md-3">
                            <form method="POST" action="{{ route('ubah_keranjang', $cart) }}" class="d-flex gap-1">
                                @csrf @method('PATCH')
                                <input type="number" name="amount" value="{{ $cart->amount }}" min="1"
                                    max="{{ $cart->product->stock }}" class="form-control form-control-sm rounded-3" style="width:72px">
                                <button class="btn btn-sm btn-um-putih" title="Perbarui"><i class="bi bi-arrow-repeat"></i></button>
                            </form>
                        </div>
                        <div class="col-4 col-md-2 harga">Rp{{ number_format($cart->amount * $cart->product->price, 0, ',', '.') }}</div>
                        <div class="col-2 col-md-1 text-end">
                            <form method="POST" action="{{ route('hapus_keranjang', $cart) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-3"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <span>Subtotal <span class="harga fs-5">Rp{{ number_format($subtotal, 0, ',', '.') }}</span></span>
                    <a href="{{ route('checkout_form', ['toko' => $storeId]) }}" class="btn btn-um px-4">
                        Checkout Toko Ini <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        @endforeach
        <p class="text-muted small text-center">Pesanan dibuat per toko, supaya pembayaranmu langsung ke penjualnya. 🤝</p>
    @endif
</div>
@endsection
