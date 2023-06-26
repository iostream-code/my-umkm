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
                        <th scope="col">Store</th>
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
                            <td>{{ $order->store->name }}</td>
                            <td>{{ $order->is_paid }}</td>
                            <td>-</td>
                            <td>
                                <div class="d-flex flex-row gap-2">
                                    <form action="" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm"><i
                                                class="bi bi-search"></i></button>
                                    </form>
                                    <form action="" method="POST">
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
