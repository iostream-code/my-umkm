@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $store->name }}
                        <button type="button" class="btn btn-success btn-sm"
                            onclick="window.location='{{ route('edit_store', $store) }}'">Edit</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 mb-3 mb-sm-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $store->name }}</h5>
                                        <p class="card-text">Store ID : {{ $store->id }}</p>
                                        {{-- <a class="btn btn-primary" href="{{ route('products') }}">View Products</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <button type="button" class="btn btn-outline-success btn-sm"
                                onclick="window.location='{{ route('create_product', $store) }}'">Add New Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
