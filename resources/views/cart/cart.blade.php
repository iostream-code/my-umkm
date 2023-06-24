@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        My Cart
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th scope="col">#</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_bayar = 0;
                                        @endphp
                                        @foreach ($carts as $item)
                                            <tr class="table-light">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>
                                                    <img class="rounded" src="{{ url('storage/' . $item->product->image) }}"
                                                        width="100">
                                                </td>
                                                <td>{{ $item->product->price }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->product->price * $item->amount }}</td>
                                                @php
                                                    $total = $item->product->price * $item->amount;
                                                    $total_bayar += $total;
                                                @endphp
                                                <td>
                                                    <form action="" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                    <form action="" method="get">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Proceed to Pay</button>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <h5>Total Bayar</h5>
                                    <p><Strong>Rp. {{ $total_bayar }}</Strong></p>
                                </div>
                            </div>
                        </div>
                        {{-- @if (Auth::user()->role == 'visitor')
                            <a class="btn btn-warning" href="{{ route('add_to_cart') }}"><i
                                    class="bi bi-cart me-1"></i></i>Checkout</a>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
