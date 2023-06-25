@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Orders') }}
                        <button type="button" onclick="window.location='{{ route('create_order') }}'" class="btn btn-success btn-sm">Add</button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
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
                                <tr>
                                    <th scope="row">#</th>
                                    <td>#####</td>
                                    <td>#####</td>
                                    <td>#####</td>
                                    <td>#####</td>
                                    <td>#####</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
