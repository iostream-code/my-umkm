@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Create Account</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name"
                                    @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus />
                                <label for="name">Full name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com"
                                    @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                    required autocomplete="email" />
                                <label for="email">Email address</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="password" type="password"
                                            placeholder="Create a password" @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password" />
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="parrword-confirm" type="password"
                                            placeholder="Confirm password" name="password_confirmation" required
                                            autocomplete="new-password" />
                                        <label for="parrword-confirm">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Create
                                        Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="{{ route('login') }}">Sudah punya akun? Login disini</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
