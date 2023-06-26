@extends('layouts.admin')

@section('content')
    <div class="container-fluid mb-5 px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Detail Product</li>
        </ol>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Product
                @if (Auth::user()->role == 'seller')
                    <button type="button" class="btn btn-success btn-sm"
                        onclick="window.location='{{ route('edit_product', $product) }}'">Edit</button>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <table class="table">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col">{{ $product->name }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-light">
                                    <td>Rp. {{ $product->price }}</td>
                                </tr>
                                <tr class="table-light">
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr class="table-light">
                                    <td>{{ $product->stock }} pcs</td>
                                </tr>
                                @if (Auth::user()->role == 'visitor')
                                    <tr class="table-light">
                                        <td>
                                            <form action="{{ route('add_to_cart', $product) }}" method="post">
                                                @csrf
                                                <div class="form-floating">
                                                    <input class="form-control" type="number" name="amount"
                                                        placeholder="Please enter the amount">
                                                    <label>Amount</label>
                                                </div>
                                                <button type="submit" class="btn btn-warning mt-3">
                                                    <i class="bi bi-cart me-1"></i></i>Add to Cart
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <img src="{{ url('storage/' . $product->image) }}" class="img-fluid img-thumbnail" alt=""
                            height="150px">
                    </div>
                </div>
                {{-- @if (Auth::user()->role == 'visitor')
                            <a class="btn btn-warning" href="{{ route('add_to_cart') }}"><i
                                    class="bi bi-cart me-1"></i></i>Checkout</a>
                        @endif --}}
            </div>
        </div>
    </div>
@endsection
