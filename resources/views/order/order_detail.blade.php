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
                    <th scope="col">Pengiriman</th>
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
                        <td><span class="badge text-bg-info">{{ $transaction->payment->is_transfer ? 'Transafer' : 'COD' }}</span></td>
                        <td>{{ $transaction->payment->delivery ? 'Diantar' : 'Ambil di toko' }}</td>
                        <td>{{ $transaction->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
