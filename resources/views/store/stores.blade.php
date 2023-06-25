@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Store</li>
        </ol>
        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stores as $store)
                    <tr class="table-light">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->email }}</td>
                        <td>{{ $store->location }}</td>
                        <td>
                            <div class="d-flex flex-row gap-2">
                                <form action="{{ route('detail_store', $store) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="bi bi-search"></i></button>
                                </form>
                                <form action="{{ route('delete_store', $store) }}" method="POST">
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
@endsection
