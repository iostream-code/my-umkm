@extends('layouts.app')

@section('title', 'Daftar Toko — MyUMKM')

@section('content')
<div class="container">
    <h1 class="h3 fw-bolder mb-4"><i class="bi bi-shop me-1 text-um"></i>Toko UMKM Kita</h1>

    <div class="row g-3 g-md-4">
        @forelse ($stores as $store)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('detail_toko', $store) }}" class="card kartu-produk p-3 text-decoration-none h-100">
                    <div class="d-flex align-items-center gap-3">
                        @if ($store->picture_url)
                            <img src="{{ $store->picture_url }}" class="rounded-3" width="56" height="56" style="object-fit: cover" alt="">
                        @else
                            <span class="d-inline-flex align-items-center justify-content-center rounded-3"
                                style="width:56px;height:56px;background:#ffedd5"><i class="bi bi-shop fs-4 text-um"></i></span>
                        @endif
                        <div class="min-w-0">
                            <span class="fw-bolder text-dark d-block text-truncate">{{ $store->name }}</span>
                            <small class="text-muted d-block text-truncate">
                                <i class="bi bi-geo-alt me-1"></i>{{ $store->location }}
                            </small>
                            <small class="text-um fw-bold">{{ $store->products_count }} produk</small>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12"><div class="card p-5 text-center text-muted">Belum ada toko. Jadilah yang pertama!</div></div>
        @endforelse
    </div>
    <div class="mt-4">{{ $stores->links('pagination::bootstrap-5') }}</div>
</div>
@endsection
