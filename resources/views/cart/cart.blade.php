@extends('layouts.home')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
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
                                <img class="rounded" src="{{ url('storage/' . $item->product->image) }}" width="100">
                            </td>
                            <td>{{ $item->product->price }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->product->price * $item->amount }}</td>
                            @php
                                $total = $item->product->price * $item->amount;
                                $total_bayar += $total;
                            @endphp
                            <td>
                                <form action="{{ route('delete_cart', $item) }}" method="post">
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
            <div class="row">
                <div class="col-10">
                    <form action="{{ route('create_payment') }}" method="get">
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
    </section>
@endsection
