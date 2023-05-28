@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ $product->name }}
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location='{{ route('edit_product', $product) }}'">Edit</button>
                </div>
                <img class="img-top" src="{{ url('storage/' . $product->image) }}" alt="">
                <div class="card-body text-center">
                    <a class="btn btn-primary" href="{{ route('products') }}">See Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection