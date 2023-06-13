@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Stores') }}
                        @if (Auth::user()->is_admin == false)
                            <button type="button" class="btn btn-success btn-sm"
                                onclick="window.location='{{ route('create_store') }}'"><i
                                    class="bi bi-house-add me-1"></i>Create</button>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
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
                </div>
            </div>
        </div>
    </div>
@endsection
