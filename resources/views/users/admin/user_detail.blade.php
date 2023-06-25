@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Hello, {{ Auth::user()->name }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $user->name }}
                        <button type="button" class="btn btn-success btn-sm"
                            onclick="window.location='{{ route('edit_user', $user) }}'">Edit</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/img/profile-img.png') }}" class="img rounded-circle" alt=""
                                    height="150px" width="150px">
                            </div>
                            <div class="col-8">
                                <div class="d-flex flex-column">
                                    <h3 class="fw-bold">{{ $user->name }}</h3>
                                    <p class="fst-italic">Email : {{ $user->email }}</p>
                                    <p class="fst-italic">Role : {{ $user->role }}</p>
                                    <p class="fw-light">Joined at {{ date('d-m-Y', strtotime($user->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
