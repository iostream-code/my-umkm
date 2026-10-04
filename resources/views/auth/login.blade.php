@extends('layouts.app')

@section('title', 'Masuk — MyUMKM')

@section('content')
<div class="container" style="max-width: 440px">
    <div class="text-center mb-4">
        <span class="fs-1">🧺</span>
        <h1 class="h3 fw-bolder">Selamat datang kembali!</h1>
        <p class="text-muted">Masuk untuk lanjut belanja atau mengurus tokomu.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold" for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control rounded-3 @error('email') is-invalid @enderror" required autofocus>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="password">Password</label>
            <input id="password" type="password" name="password"
                class="form-control rounded-3 @error('password') is-invalid @enderror" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>
        <button class="btn btn-um btn-lg w-100 mb-2">Masuk</button>
        <p class="text-center small mb-0">Belum punya akun?
            <a href="{{ route('register') }}" class="text-um fw-bold">Daftar gratis</a>
        </p>
    </form>
</div>
@endsection
