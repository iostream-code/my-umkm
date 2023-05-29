@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $product->name }}
                        <button type="button" class="btn btn-success btn-sm"
                            onclick="window.location='{{ route('edit_product', $product) }}'">Edit</button>
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-2">
                                <img src="{{ url('storage/' . $product->image) }}" class="img" alt="" height="150px">
                            </div>
                        </div>
                        <a class="btn btn-warning" href=""><i class="bi bi-cart-fill"></i></i>Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
