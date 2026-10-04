@extends('layouts.app')

@section('title', 'Toko Saya — MyUMKM')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <h1 class="h3 fw-bolder mb-0"><i class="bi bi-shop me-1 text-um"></i>{{ $store->name }}</h1>
        <a href="{{ route('detail_toko', $store) }}" class="btn btn-um-putih btn-sm">
            <i class="bi bi-eye me-1"></i>Lihat Toko Publik
        </a>
    </div>

    {{-- Statistik ringkas --}}
    <div class="row g-3 mb-4">
        <div class="col-4">
            <div class="card p-3 text-center h-100">
                <span class="fs-4 fw-bolder">{{ $stats['produk'] }}</span>
                <small class="text-muted">Produk</small>
            </div>
        </div>
        <div class="col-4">
            <a href="{{ route('pesanan_masuk', ['status' => 'menunggu_konfirmasi']) }}" class="card p-3 text-center h-100 text-decoration-none">
                <span class="fs-4 fw-bolder {{ $stats['perlu_konfirmasi'] ? 'text-danger' : 'text-dark' }}">{{ $stats['perlu_konfirmasi'] }}</span>
                <small class="text-muted">Perlu Konfirmasi</small>
            </a>
        </div>
        <div class="col-4">
            <div class="card p-3 text-center h-100">
                <span class="fs-6 fs-md-4 fw-bolder harga">Rp{{ number_format($stats['penjualan'], 0, ',', '.') }}</span>
                <small class="text-muted">Penjualan</small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Produk --}}
        <div class="col-lg-7">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h6 fw-bolder text-uppercase text-muted mb-0">Produk Saya</h2>
                    <a href="{{ route('produk_tambah') }}" class="btn btn-um btn-sm"><i class="bi bi-plus-lg me-1"></i>Pasang Produk</a>
                </div>
                @forelse ($products as $product)
                    <div class="d-flex align-items-center gap-2 border-bottom py-2">
                        <img src="{{ $product->image_url }}" width="44" height="44" class="rounded-3" style="object-fit:cover" alt="">
                        <div class="min-w-0 flex-grow-1">
                            <span class="fw-bold d-block text-truncate">{{ $product->name }}</span>
                            <small class="text-muted">Rp{{ number_format($product->price, 0, ',', '.') }} · stok {{ $product->stock }}</small>
                        </div>
                        <a href="{{ route('produk_edit', $product) }}" class="btn btn-sm btn-um-putih"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('produk_hapus', $product) }}"
                            onsubmit="return confirm('Hapus {{ $product->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger rounded-3"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted text-center py-3 mb-0">Belum ada produk. Pasang produk pertamamu!</p>
                @endforelse
                <div class="mt-3">{{ $products->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>

        <div class="col-lg-5">
            {{-- Pesanan masuk --}}
            <div class="card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h6 fw-bolder text-uppercase text-muted mb-0">Pesanan Masuk</h2>
                    <a href="{{ route('pesanan_masuk') }}" class="small fw-bold text-um text-decoration-none">Semua →</a>
                </div>
                @forelse ($pesananMasuk as $order)
                    <a href="{{ route('detail_pesanan', $order) }}" class="d-flex justify-content-between align-items-center border-bottom py-2 text-decoration-none">
                        <span>
                            <span class="fw-bold text-dark">#{{ $order->id }} · {{ $order->user->name }}</span>
                            <small class="d-block text-muted">Rp{{ number_format($order->total, 0, ',', '.') }}</small>
                        </span>
                        <span class="badge text-bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
                    </a>
                @empty
                    <p class="text-muted text-center py-3 mb-0">Belum ada pesanan aktif.</p>
                @endforelse
            </div>

            {{-- Pengaturan toko --}}
            <div class="card p-4">
                <h2 class="h6 fw-bolder text-uppercase text-muted mb-3">Pengaturan Toko</h2>
                <form method="POST" action="{{ route('update_toko') }}" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="mb-2">
                        <label class="form-label fw-bold small mb-1">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $store->name) }}" class="form-control form-control-sm rounded-3" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-bold small mb-1">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $store->location) }}" class="form-control form-control-sm rounded-3" required>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-5">
                            <label class="form-label fw-bold small mb-1">Bank</label>
                            <input type="text" name="bank" value="{{ old('bank', $store->bank) }}" class="form-control form-control-sm rounded-3" required>
                        </div>
                        <div class="col-7">
                            <label class="form-label fw-bold small mb-1">No. Rekening</label>
                            <input type="text" name="no_rek" value="{{ old('no_rek', $store->no_rek) }}" class="form-control form-control-sm rounded-3" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-bold small mb-1">Cerita toko</label>
                        <textarea name="description" rows="2" class="form-control form-control-sm rounded-3">{{ old('description', $store->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small mb-1">Foto toko</label>
                        <input type="file" name="picture" accept="image/*" class="form-control form-control-sm rounded-3">
                    </div>
                    <button class="btn btn-um btn-sm w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
