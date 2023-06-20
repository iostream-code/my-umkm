@extends('layouts.app')

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
@endsection
