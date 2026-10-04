@extends('layouts.app')

@section('title', $product->name . ' — MyUMKM')

@section('content')
<div class="container">
    <div class="row g-4 mb-5">
        <div class="col-md-5">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-100 rounded-4"
                style="aspect-ratio: 1; object-fit: cover">
        </div>
        <div class="col-md-7">
            <span class="badge badge-kategori mb-2">{{ $product->category }}</span>
            <h1 class="h3 fw-bolder">{{ $product->name }}</h1>
            <p class="harga display-5 mb-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="mb-1 fw-semibold">
                @if ($product->stock > 0)
                    <span class="text-success"><i class="bi bi-check-circle me-1"></i>Stok {{ $product->stock }}</span>
                @else
                    <span class="text-danger"><i class="bi bi-x-circle me-1"></i>Stok habis</span>
                @endif
            </p>
            <p class="text-muted">{{ $product->description }}</p>

            <a href="{{ route('detail_toko', $product->store) }}"
                class="card p-3 mb-3 text-decoration-none d-flex flex-row align-items-center gap-3" style="max-width: 420px">
                <span class="fs-3"><i class="bi bi-shop text-um"></i></span>
                <span>
                    <span class="fw-bolder text-dark d-block">{{ $product->store->name }}</span>
                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $product->store->location }}</small>
                </span>
                <i class="bi bi-chevron-right ms-auto text-muted"></i>
            </a>

            @auth
                @if ($product->store->user_id !== auth()->id() && $product->stock > 0)
                    <form method="POST" action="{{ route('tambah_keranjang', $product) }}" class="d-flex gap-2" style="max-width: 380px">
                        @csrf
                        <input type="number" name="amount" value="1" min="1" max="{{ $product->stock }}"
                            class="form-control rounded-4" style="width: 90px">
                        <button class="btn btn-um btn-lg flex-grow-1">
                            <i class="bi bi-cart-plus me-1"></i>Masukkan Keranjang
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-um btn-lg px-4">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Masuk untuk Membeli
                </a>
            @endauth
        </div>
    </div>

    @if ($lainnya->isNotEmpty())
        <h2 class="h5 fw-bolder mb-3">Produk lain dari {{ $product->store->name }}</h2>
        <div class="row g-3 g-md-4">
            @foreach ($lainnya as $product)
                <div class="col-6 col-md-3">
                    @include('partials.kartu_produk')
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
