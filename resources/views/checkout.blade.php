@extends('layouts.app')

@section('title', 'Checkout — MyUMKM')

@section('content')
<div class="container" style="max-width: 820px">
    <h1 class="h3 fw-bolder mb-4"><i class="bi bi-bag-check me-1 text-um"></i>Checkout — {{ $store->name }}</h1>

    <div class="row g-4">
        <div class="col-md-7">
            <form method="POST" action="{{ route('checkout') }}" class="card p-4">
                @csrf
                <input type="hidden" name="store_id" value="{{ $store->id }}">
                <h2 class="h6 fw-bolder text-uppercase text-muted mb-3">Dikirim ke mana?</h2>
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Penerima</label>
                    <input type="text" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name) }}"
                        class="form-control rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">No. HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control rounded-3"
                        placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Alamat Lengkap</label>
                    <textarea name="address" rows="3" class="form-control rounded-3" required
                        placeholder="Jalan, RT/RW, desa/kelurahan, kecamatan, kota">{{ old('address') }}</textarea>
                </div>
                <button class="btn btn-um btn-lg">Buat Pesanan</button>
            </form>
        </div>

        <div class="col-md-5">
            <div class="card p-4">
                <h2 class="h6 fw-bolder text-uppercase text-muted mb-3">Belanjaanmu</h2>
                @foreach ($carts as $cart)
                    <div class="d-flex justify-content-between small mb-2">
                        <span>{{ $cart->product->name }} × {{ $cart->amount }}</span>
                        <span class="fw-bold">Rp{{ number_format($cart->amount * $cart->product->price, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Total</span>
                    <span class="harga fs-4">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="alert alert-warning rounded-3 small mt-3 mb-0">
                    <i class="bi bi-info-circle me-1"></i>
                    Pembayaran: transfer ke <strong>{{ $store->bank }} {{ $store->no_rek }}</strong>
                    (a.n. pemilik {{ $store->name }}) setelah pesanan dibuat.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
