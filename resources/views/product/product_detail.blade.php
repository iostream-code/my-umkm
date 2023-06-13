@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $product->name }}
                        @if (!Auth::user()->is_admin)
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-4">
                                <img src="{{ url('storage/' . $product->image) }}" class="img-fluid img-thumbnail"
                                    alt="" height="150px">
                            </div>
                        </div>
                        @if (!Auth::user()->is_admin)
                            <a class="btn btn-warning" href="{{ route('add_to_cart') }}"><i class="bi bi-cart me-1"></i></i>Checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
