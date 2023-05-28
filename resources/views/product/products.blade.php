@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Products') }}
                        <button type="button" class="btn btn-success btn-sm"
                            onclick="window.location='{{ route('create_product') }}'">Create</button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                            <img src="{{ url('storage/' . $product->image) }}" alt="" height="150px">
                                        </td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <div class="d-flex flex-row gap-2">
                                                <form action="{{ route('detail_product', $product) }}" method="GET">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                                            class="bi bi-search"></i></button>
                                                </form>
                                                <form action="{{ route('delete_product', $product) }}" method="POST">
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
                </div>
            </div>
        </div>
    </div>
@endsection
