@extends('layouts.home')

@section('content')
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <table class="table">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Product</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($order->transactions as $transaction)
                        <tr class="table-light">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $transaction->product->name }}</td>
                            <td>{{ $transaction->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- @if ($order->is_paid == false && $order->payment_receipt == null)
                <form action="{{ route('submit_payment', $order) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="payment_receipt">Upload Payement Receipt</label>
                        <input class="form-control" type="file" name="payment_receipt" id="payment_receipt">
                    </div>

                    <button class="btn btn-primary" type="submit">Upload</button>
                </form>
            @endif --}}
        </div>
    </section>
@endsection
