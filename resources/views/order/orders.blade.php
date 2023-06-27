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
                <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment Receipt</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="table-light">
                        <th scope="row"></th>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>
                            @if ($order->is_paid)
                                <span class="badge text-bg-success">Paid</span>
                            @else
                                <span class="badge text-bg-danger">unpaid</span>
                            @endif
                        </td>
                        <td>
                            @isset($order->payment_receipt)
                                <a href="#">view file</a>
                            @endisset
                        </td>
                        <td>
                            <div class="d-flex flex-row gap-2">
                                <form action="#" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="bi bi-search"></i></button>
                                </form>
                                <form action="{{ route('delete_order', $order) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                                <form action="" method="post">
                                    @csrf
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
