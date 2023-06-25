@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
        </div>
    </div>
@endsection
