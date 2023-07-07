@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Product</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($order->transactions as $transaction)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $transaction->payment->receiver }}</td>
                        <td>{{ $transaction->product->name }}</td>
                        <td>{{ $transaction->payment->address }}</td>
                        <td>{{ $transaction->payment->is_transfer ? 'Transafer' : 'COD' }}</td>
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
@endsection
