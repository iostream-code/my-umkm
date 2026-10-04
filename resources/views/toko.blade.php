@extends('layouts.app')

@section('title', $store->name . ' — MyUMKM')

@section('content')
<div class="container">
    <div class="card p-4 mb-4" style="background: linear-gradient(120deg, #fff7ed, #ffedd5)">
        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
            @if ($store->picture_url)
                <img src="{{ $store->picture_url }}" class="rounded-4" width="88" height="88" style="object-fit: cover" alt="">
            @else
                <span class="d-inline-flex align-items-center justify-content-center rounded-4 bg-white"
                    style="width:88px;height:88px"><i class="bi bi-shop fs-1 text-um"></i></span>
            @endif
            <div class="flex-grow-1">
                <h1 class="h4 fw-bolder mb-1">{{ $store->name }}</h1>
                <p class="mb-1 text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $store->location }}</p>
                @if ($store->description)
                    <p class="mb-0 small">{{ $store->description }}</p>
                @endif
            </div>
            <span class="badge badge-kategori fs-6">{{ $products->total() }} produk</span>
        </div>
    </div>

    @if ($products->isEmpty())
        <div class="card p-5 text-center text-muted">Toko ini belum memasang produk.</div>
    @else
        <div class="row g-3 g-md-4">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    @include('partials.kartu_produk')
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $products->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection
