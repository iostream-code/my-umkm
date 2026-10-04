@extends('layouts.app')

@section('title', "Pesanan #{$order->id} — MyUMKM")

@section('content')
<div class="container" style="max-width: 860px">
    @php($sayaPembeli = $order->user_id === auth()->id())
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bolder mb-0">Pesanan #{{ $order->id }}</h1>
        <span class="badge fs-6 text-bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
    </div>

    <div class="row g-4">
        <div class="col-md-7">
            <div class="card p-4 mb-4">
                <h2 class="h6 fw-bolder text-uppercase text-muted mb-3">
                    <i class="bi bi-shop me-1"></i>{{ $order->store?->name }}
                </h2>
                @foreach ($order->transactions as $trx)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $trx->product?->name ?? 'Produk terhapus' }} × {{ $trx->amount }}</span>
                        <span class="fw-bold">Rp{{ number_format($trx->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total</span>
                    <span class="harga fs-4">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="card p-4">
                <h2 class="h6 fw-bolder text-uppercase text-muted mb-3">Alamat Pengiriman</h2>
                <p class="mb-1 fw-bold">{{ $order->recipient_name }} · {{ $order->phone }}</p>
                <p class="text-muted mb-0">{{ $order->address }}</p>
            </div>
        </div>

        <div class="col-md-5">
            @if ($order->status === 'menunggu_pembayaran' && $sayaPembeli)
                <div class="card p-4">
                    <h2 class="h6 fw-bolder text-uppercase text-muted mb-3">Cara Bayar</h2>
                    <div class="alert alert-warning rounded-3 small">
                        Transfer <strong class="harga">Rp{{ number_format($order->total, 0, ',', '.') }}</strong> ke:<br>
                        <span class="fs-5 fw-bolder">{{ $order->store->bank }} {{ $order->store->no_rek }}</span><br>
                        <small>Toko {{ $order->store->name }}</small>
                    </div>
                    <form method="POST" action="{{ route('kirim_bukti', $order) }}" enctype="multipart/form-data">
                        @csrf
                        <label class="form-label fw-bold">Unggah bukti transfer</label>
                        <input type="file" name="payment_receipt" accept="image/*" class="form-control rounded-3 mb-3" required>
                        <button class="btn btn-um w-100"><i class="bi bi-upload me-1"></i>Kirim Bukti Bayar</button>
                    </form>
                </div>
            @elseif ($order->status === 'menunggu_konfirmasi')
                <div class="card p-4 text-center">
                    <i class="bi bi-hourglass-split fs-1 text-warning"></i>
                    <p class="fw-bold mt-2 mb-2">Bukti bayar sudah dikirim.</p>
                    <p class="small text-muted mb-2">Menunggu konfirmasi dari penjual.</p>
                    <a href="{{ route('bukti_bayar', $order) }}" target="_blank" class="btn btn-um-putih btn-sm">Lihat bukti</a>
                </div>
            @else
                <div class="card p-4 text-center">
                    <i class="bi bi-patch-check fs-1 text-success"></i>
                    <p class="fw-bold mt-2 mb-0">Pembayaran diterima penjual.<br>Terima kasih sudah belanja di UMKM! 🧡</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
