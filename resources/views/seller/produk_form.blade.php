@extends('layouts.app')

@section('title', ($product->exists ? 'Ubah' : 'Pasang') . ' Produk — MyUMKM')

@section('content')
<div class="container" style="max-width: 640px">
    <h1 class="h3 fw-bolder mb-4">{{ $product->exists ? '✏️ Ubah Produk' : '🛍️ Pasang Produk Baru' }}</h1>

    <form method="POST" enctype="multipart/form-data" class="card p-4"
        action="{{ $product->exists ? route('produk_update', $product) : route('produk_simpan') }}">
        @csrf
        @if ($product->exists) @method('PATCH') @endif

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control rounded-3"
                placeholder="mis. Keripik Tempe Original 200g" required>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label class="form-label fw-bold">Kategori</label>
                <select name="category" class="form-select rounded-3" required>
                    @foreach (\App\Models\Product::KATEGORI as $kategori)
                        <option value="{{ $kategori }}" @selected(old('category', $product->category) === $kategori)>{{ $kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0"
                    class="form-control rounded-3" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                    class="form-control rounded-3" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Deskripsi</label>
            <textarea name="description" rows="3" class="form-control rounded-3" required
                placeholder="Ceritakan keunggulan produkmu...">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Foto Produk {{ $product->exists ? '(kosongkan jika tetap)' : '' }}</label>
            <input type="file" name="image" accept="image/*" class="form-control rounded-3" {{ $product->exists ? '' : 'required' }}>
            @if ($product->exists)
                <img src="{{ $product->image_url }}" class="rounded-3 mt-2" width="110" alt="">
            @endif
            <small class="text-muted d-block mt-1">Foto otomatis dirapikan & dikompres (WebP), jadi upload saja dari HP.</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('toko_saya') }}" class="btn btn-um-putih flex-grow-1">Batal</a>
            <button class="btn btn-um flex-grow-1">Simpan</button>
        </div>
    </form>
</div>
@endsection
