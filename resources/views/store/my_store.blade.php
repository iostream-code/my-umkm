@extends('layouts.admin')

@section('content')
    <div class="container-fluid mb-5 px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Store</li>
        </ol>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @if (isset($store))
                    My Store
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('create_product', $store) }}">Add
                                    Product</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('edit_store', $store) }}">Edit Store</a>
                            </li>
                        </ul>
                    </div>
                @else
                    Welcome to Store Page!
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    @if (isset($store))
                        <img src="{{ url('storage/' . $store->picture) }}" class="img-fluid mb-4" alt="">
                        @foreach ($products as $product)
                            <div class="col-sm-4 mb-3 mb-sm-2">
                                <div class="card">
                                    <img src="{{ url('storage/' . $product->image) }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">Rp. {{ $product->price }}</p>
                                        <p class="card-text">Available {{ $product->stock }} pcs</p>
                                        <a href="{{ route('detail_product', $product, $store) }}"
                                            class="btn btn-primary btn-sm" type="button"><i class="bi bi-search"></i></a>
                                        <a href="{{ route('delete_product', $product) }}" class="btn btn-danger btn-sm"
                                            type="button"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex flex-row justify-content-center align-content-center">
                            <a class="link-success" href="{{ route('create_store') }}">
                                <h1><i class="bi bi-house-add"></i> Create Store</h1>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
