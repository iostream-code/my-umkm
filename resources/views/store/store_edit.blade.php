@extends('layouts.admin')

@section('content')
    <div class="container-fluid mb-5 px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Store</li>
            <li class="breadcrumb-item active">Edit Store</li>
        </ol>
        <div class="card">
            <div class="card-header">My Store</div>
            <div class="card-body">
                <form action="{{ route('update_store', $store) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="name" class="form-label">Store Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $store->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" value="{{ $store->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="picture" class="form-label">Banner</label>
                        <input type="file" class="form-control" name="picture">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" value="{{ $store->location }}">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
