@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item">{{ $user->name }}</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit {{ $user->name }}</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
