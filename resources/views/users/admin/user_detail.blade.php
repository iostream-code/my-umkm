@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
                                <img src="/storage/profile-picture.jpg" class="img rounded-circle" alt=""
                                    height="150px" width="150px">
                            </div>
                            <div class="col-8">
                                <div class="d-flex flex-column">
                                    <h3 class="fw-bold">{{ $user->email }}</h3>
                                    <p class="fst-italic">Role : {{ $user->role }}</p>
                                    <p class="fw-light">Joined at May, 2023</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
