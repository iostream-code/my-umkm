@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Sapaan + pencarian besar: langsung belanja, tanpa basa-basi --}}
    <div class="text-center mb-4">
        <h1 class="fw-black" style="font-weight: 900">
            Mau belanja apa hari ini? <span class="text-um">🧺</span>
        </h1>
        <p class="text-muted mb-3">Produk asli buatan UMKM — langsung dari tetangga kita sendiri.</p>
        <form method="GET" action="{{ route('beranda') }}" class="mx-auto" style="max-width: 560px">
            <div class="position-relative">
                <input type="search" name="q" value="{{ request('q') }}" class="form-control cari-besar"
                    placeholder="Cari keripik, batik, kopi, kerajinan...">
                <button class="btn btn-um position-absolute top-50 end-0 translate-middle-y me-2 px-3 py-1">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
            @if (request('kategori'))
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
        </form>
    </div>

    {{-- Chip kategori --}}
    <div class="d-flex gap-2 overflow-auto pb-2 mb-4 justify-content-md-center">
        <a href="{{ route('beranda', request()->only('q')) }}" class="chip {{ request('kategori') ? '' : 'aktif' }}">Semua</a>
        @foreach (\App\Models\Product::KATEGORI as $kategori)
            <a href="{{ route('beranda', array_merge(request()->only('q'), ['kategori' => $kategori])) }}"
                class="chip {{ request('kategori') === $kategori ? 'aktif' : '' }}">{{ $kategori }}</a>
        @endforeach
    </div>

    {{-- Ajakan buka toko (hanya yang belum punya) --}}
    @unless (auth()->user()?->store)
        <div class="card mb-4 p-3 px-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2"
            style="background: linear-gradient(120deg, #fff7ed, #ffedd5)">
            <div>
                <span class="fw-bolder">Punya usaha? Jualan di sini, gratis!</span>
                <small class="d-block text-muted">Cukup 1 menit — isi nama toko, rekening, langsung bisa pasang produk.</small>
            </div>
            <a href="{{ auth()->check() ? route('buka_toko') : route('register') }}" class="btn btn-um px-4 flex-shrink-0">
                <i class="bi bi-shop me-1"></i>Buka Toko Gratis
            </a>
        </div>
    @endunless

    {{-- Grid produk --}}
    @if ($products->isEmpty())
        <div class="card p-5 text-center text-muted">
            <i class="bi bi-basket fs-1"></i>
            <p class="mb-0 mt-2">Belum ketemu. Coba kata kunci lain ya!</p>
        </div>
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
