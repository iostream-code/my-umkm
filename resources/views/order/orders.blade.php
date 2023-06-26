@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
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
                <tr class="table-light">
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
                                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button>
                            </form>
                            <form action="" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection
