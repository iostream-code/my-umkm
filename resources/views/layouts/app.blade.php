<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MyUMKM — Belanja Langsung dari UMKM')</title>

    <link href="https://fonts.bunny.net/css?family=nunito:400,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --um-oranye: #ea580c;
            --um-oranye-tua: #c2410c;
            --um-kuning: #fbbf24;
            --um-krem: #fff8f0;
            --um-coklat: #431407;
        }
        body { font-family: 'Nunito', system-ui, sans-serif; background: var(--um-krem); color: var(--um-coklat); }
        .btn-um { background: var(--um-oranye); color: #fff; font-weight: 800; border-radius: .9rem; }
        .btn-um:hover { background: var(--um-oranye-tua); color: #fff; }
        .btn-um-kuning { background: var(--um-kuning); color: var(--um-coklat); font-weight: 800; border-radius: .9rem; }
        .btn-um-kuning:hover { background: #f59e0b; color: var(--um-coklat); }
        .btn-um-putih { background: #fff; color: var(--um-oranye); font-weight: 800; border: 2px solid #fed7aa; border-radius: .9rem; }
        .btn-um-putih:hover { border-color: var(--um-oranye); color: var(--um-oranye-tua); }
        .text-um { color: var(--um-oranye) !important; }
        .navbar-um { background: var(--um-oranye); }
        .navbar-um .nav-link, .navbar-um .navbar-brand { color: #fff; font-weight: 700; }
        .navbar-um .nav-link:hover { color: #ffedd5; }
        .card { border: 1px solid #fde8d4; border-radius: 1.1rem; background: #fff; }
        .kartu-produk { transition: transform .15s, box-shadow .15s; overflow: hidden; }
        .kartu-produk:hover { transform: translateY(-4px); box-shadow: 0 .8rem 1.6rem rgba(234,88,12,.15); }
        .kartu-produk img { aspect-ratio: 1; object-fit: cover; width: 100%; }
        .harga { color: var(--um-oranye); font-weight: 900; }
        .chip { background: #fff; border: 2px solid #fed7aa; color: var(--um-coklat); border-radius: 999px; padding: .35rem 1rem; font-weight: 700; font-size: .875rem; text-decoration: none; white-space: nowrap; }
        .chip.aktif, .chip:hover { background: var(--um-oranye); border-color: var(--um-oranye); color: #fff; }
        .badge-kategori { background: #ffedd5; color: var(--um-oranye-tua); font-weight: 800; }
        .cari-besar { border: 3px solid var(--um-oranye); border-radius: 999px; padding: .7rem 1.4rem; font-weight: 600; }
        .cari-besar:focus { outline: none; box-shadow: 0 0 0 .25rem rgba(234,88,12,.15); }
        footer { background: var(--um-coklat); color: #ffedd5; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-um navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-black fs-4" href="{{ route('beranda') }}">
                <i class="bi bi-basket2-fill me-1 text-warning"></i>MyUMKM
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUm">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navUm">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('beranda') }}">Belanja</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('daftar_toko') }}">Daftar Toko</a></li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-md-center gap-md-1">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('keranjang') }}" title="Keranjang">
                                <i class="bi bi-cart3 fs-5"></i>
                                @php($jml = \App\Models\Cart::where('user_id', Auth::id())->count())
                                @if ($jml)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">{{ $jml }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('pesanan') }}">
                                    <i class="bi bi-receipt me-2"></i>Pesanan Saya</a></li>
                                @if (Auth::user()->store)
                                    <li><a class="dropdown-item" href="{{ route('toko_saya') }}">
                                        <i class="bi bi-shop me-2"></i>Toko Saya</a></li>
                                @else
                                    <li><a class="dropdown-item text-um fw-bold" href="{{ route('buka_toko') }}">
                                        <i class="bi bi-shop me-2"></i>Buka Toko Gratis</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Masuk</a></li>
                        <li class="nav-item">
                            <a class="btn btn-um-kuning btn-sm px-3 ms-md-1" href="{{ route('register') }}">Daftar Gratis</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4">
                    <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-4">
                    <i class="bi bi-exclamation-triangle me-1"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        @yield('content')
    </main>

    <footer class="py-4 mt-5">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span class="fw-bold"><i class="bi bi-basket2-fill me-1 text-warning"></i>MyUMKM — dari UMKM, untuk kita semua</span>
            <small class="opacity-75">© {{ date('Y') }} · Laravel 12</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
