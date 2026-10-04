@extends('layouts.app')

@section('title', 'Pesanan Saya — MyUMKM')

@section('content')
<div class="container" style="max-width: 820px">
    <h1 class="h3 fw-bolder mb-4"><i class="bi bi-receipt me-1 text-um"></i>Pesanan Saya</h1>

    @if ($orders->isEmpty())
        <div class="card p-5 text-center text-muted">
            <i class="bi bi-receipt-cutoff fs-1"></i>
            <p class="mt-2">Belum ada pesanan.</p>
            <a href="{{ route('beranda') }}" class="btn btn-um mx-auto px-4">Yuk Belanja</a>
        </div>
    @else
        @foreach ($orders as $order)
            <a href="{{ route('detail_pesanan', $order) }}" class="card kartu-produk p-3 mb-3 text-decoration-none">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <span class="fw-bolder text-dark">#{{ $order->id }} · {{ $order->store?->name }}</span>
                        <small class="text-muted d-block">
                            {{ $order->created_at->translatedFormat('d M Y H:i') }} · {{ $order->transactions_count }} barang
                        </small>
                    </div>
                    <div class="text-end">
                        <span class="badge text-bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
                        <p class="harga mb-0">Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </a>
        @endforeach
        {{ $orders->links('pagination::bootstrap-5') }}
    @endif
</div>
@endsection
