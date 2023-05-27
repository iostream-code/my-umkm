@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $store->name }}
                        <button type="button" class="btn btn-success btn-sm"
                            onclick="window.location='{{ route('edit_store', $store) }}'">Edit</button>
                    </div>
                    <div class="card-body text-center">
                        <img class="img-fluid" src="{{ url('storage/store-banner-1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
