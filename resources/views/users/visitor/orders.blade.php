@extends('layouts.home')

@section('content')
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
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
                    @foreach ($order as $order)
                        <tr class="table-light">
                            <th scope="row">{{ $loop->iteration }}</th>
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
                                    <form action="{{ route('detail_order', $order) }}" method="GET">
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
