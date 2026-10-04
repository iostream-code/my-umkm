@extends('layouts.app')

@section('title', 'Buka Toko Gratis — MyUMKM')

@section('content')
<div class="container" style="max-width: 640px">
    <div class="text-center mb-4">
        <span class="fs-1">🏪</span>
        <h1 class="h3 fw-bolder">Buka Toko Gratis</h1>
        <p class="text-muted">Satu menit saja — isi yang penting-penting, langsung bisa jualan.</p>
    </div>

    <form method="POST" action="{{ route('buka_toko_simpan') }}" enctype="multipart/form-data" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Nama Toko</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-3"
                placeholder="mis. Warung Bu Siti" required>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Email Toko</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-3" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Lokasi (kota/desa)</label>
                <input type="text" name="location" value="{{ old('location') }}" class="form-control rounded-3"
                    placeholder="mis. Magetan, Jawa Timur" required>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Bank</label>
                <input type="text" name="bank" value="{{ old('bank') }}" class="form-control rounded-3"
                    placeholder="mis. BRI" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">No. Rekening</label>
                <input type="text" name="no_rek" value="{{ old('no_rek') }}" class="form-control rounded-3" required>
                <small class="text-muted">Pembayaran pembeli langsung masuk ke rekeningmu.</small>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Cerita singkat toko <span class="text-muted fw-normal">(opsional)</span></label>
            <textarea name="description" rows="2" class="form-control rounded-3"
                placeholder="mis. Keripik tempe renyah buatan rumah sejak 2015">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Foto Toko <span class="text-muted fw-normal">(opsional)</span></label>
            <input type="file" name="picture" accept="image/*" class="form-control rounded-3">
        </div>
        <button class="btn btn-um btn-lg"><i class="bi bi-shop me-1"></i>Buka Toko Sekarang</button>
    </form>
</div>
@endsection
