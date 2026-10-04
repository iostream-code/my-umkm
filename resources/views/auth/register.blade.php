@extends('layouts.app')

@section('title', 'Daftar — MyUMKM')

@section('content')
<div class="container" style="max-width: 440px">
    <div class="text-center mb-4">
        <span class="fs-1">🤝</span>
        <h1 class="h3 fw-bolder">Gabung MyUMKM</h1>
        <p class="text-muted">Gratis selamanya — untuk pembeli maupun penjual.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold" for="name">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                class="form-control rounded-3 @error('name') is-invalid @enderror" required autofocus>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control rounded-3 @error('email') is-invalid @enderror" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="password">Password</label>
            <input id="password" type="password" name="password"
                class="form-control rounded-3 @error('password') is-invalid @enderror" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold" for="password-confirm">Ulangi Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" class="form-control rounded-3" required>
        </div>
        <button class="btn btn-um btn-lg w-100 mb-2">Daftar Sekarang</button>
        <p class="text-center small mb-0">Sudah punya akun?
            <a href="{{ route('login') }}" class="text-um fw-bold">Masuk</a>
        </p>
    </form>
</div>
@endsection
