@extends('layouts.home')

@section('content')
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $store->name }} - {{ $store->no_rek }} ({{ $store->bank }})
                        @if (Auth::user()->seller && Auth::id() == $store->user_id)
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Menu
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('create_product', $store) }}">Add
                                            Product</a></li>
                                    <li><a class="dropdown-item" href="{{ route('edit_store', $store) }}">Edit Store</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <img src="{{ url('storage/' . $store->picture) }}" class="img-fluid mb-4" alt="">
                            @foreach ($products as $product)
                                <div class="col-sm-4 mb-3 mb-sm-2">
                                    <div class="card">
                                        <img src="{{ url('storage/' . $product->image) }}" class="card-img-top"
                                            alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">Rp. {{ $product->price }}</p>
                                            <p class="card-text">Available {{ $product->stock }} pcs</p>
                                            <a href="{{ route('detail_product', $product) }}" class="btn btn-primary btn-sm"
                                                type="button"><i class="bi bi-search"></i></a>
                                            @if (Auth::user()->role == 'seller' && Auth::id() == $store->user_id)
                                                <a href="{{ route('delete_product', $product) }}"
                                                    class="btn btn-danger btn-sm" type="button"><i
                                                        class="bi bi-trash"></i></a>
                                            @endif
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
