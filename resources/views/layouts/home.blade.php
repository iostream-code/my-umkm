{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach ($stores as $store)
                                <div class="col-sm-4 mb-3 mb-sm-2">
                                    <div class="card">
                                        <img src="{{ url('storage/' . $store->picture) }}" class="card-img-top"
                                            alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $store->name }}</h5>
                                            <p class="card-text">{{ $store->location }}</p>
                                            <p class="card-text">{{ $store->email }}</p>
                                            <a href="{{ route('detail_store', $store) }}" class="btn btn-primary btn-sm"
                                                type="button"><i class="bi bi-search"></i> Kunjungi Toko</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>My UMKM - Kelurahan Bendul Merisi</title>

    <!-- Favicon-->
    {{-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> --}}
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet" />
</head>

<body>
    @include('layouts.component.home.navbar')
    @yield('content')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
