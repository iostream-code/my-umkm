@extends('layouts.app')

@section('title', 'Pesanan Masuk — MyUMKM')

@section('content')
<div class="container" style="max-width: 920px">
    <h1 class="h3 fw-bolder mb-4"><i class="bi bi-inbox me-1 text-um"></i>Pesanan Masuk</h1>

    <div class="mb-3 d-flex flex-wrap gap-2">
        <a href="{{ route('pesanan_masuk') }}" class="chip {{ request('status') ? '' : 'aktif' }}">Semua</a>
        @foreach (\App\Models\Order::STATUS as $kode => $info)
            <a href="{{ route('pesanan_masuk', ['status' => $kode]) }}"
                class="chip {{ request('status') === $kode ? 'aktif' : '' }}">{{ $info['label'] }}</a>
        @endforeach
    </div>

    @forelse ($orders as $order)
        <div class="card p-3 p-md-4 mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <span class="fw-bolder">#{{ $order->id }} · {{ $order->user->name }}</span>
                    <small class="text-muted d-block">
                        {{ $order->created_at->translatedFormat('d M Y H:i') }} ·
                        {{ $order->transactions_count }} barang ·
                        <span class="harga">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
                    </small>
                    <small class="text-muted d-block">{{ $order->recipient_name }} · {{ $order->phone }}</small>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="badge text-bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
                    @if ($order->payment_receipt)
                        <a href="{{ route('bukti_bayar', $order) }}" target="_blank" class="btn btn-sm btn-um-putih">
                            <i class="bi bi-image me-1"></i>Bukti
                        </a>
                    @endif
                    <a href="{{ route('detail_pesanan', $order) }}" class="btn btn-sm btn-um-putih">
                        <i class="bi bi-eye me-1"></i>Detail
                    </a>
                    @if ($order->status === 'menunggu_konfirmasi')
                        <form method="POST" action="{{ route('ubah_status_pesanan', $order) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="diproses">
                            <button class="btn btn-sm btn-um"><i class="bi bi-check2-circle me-1"></i>Terima Bayaran</button>
                        </form>
                    @elseif (in_array($order->status, ['diproses', 'dikirim']))
                        <form method="POST" action="{{ route('ubah_status_pesanan', $order) }}" class="d-flex gap-1">
                            @csrf @method('PATCH')
                            <select name="status" class="form-select form-select-sm rounded-3" style="width:auto">
                                @foreach (\App\Models\Order::STATUS as $kode => $info)
                                    <option value="{{ $kode }}" @selected($order->status === $kode)>{{ $info['label'] }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-um">OK</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="card p-5 text-center text-muted">Belum ada pesanan masuk.</div>
    @endforelse
    {{ $orders->links('pagination::bootstrap-5') }}
</div>
@endsection
