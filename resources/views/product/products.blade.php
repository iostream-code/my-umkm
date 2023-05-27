@extends('layouts.app')

@section('content')
    <div class="container-lg text-center">
        <div class="row">
            <div class="col">
                <img src="{{ url('storage/banner-1.png') }}" alt="" height="400px">
            </div>
            <div class="col">
                <div class="row">
                    <img src="{{ url('storage/banner-2.png') }}" alt="" height="200px">
                </div>
                <div class="row">
                    <img src="{{ url('storage/banner-2.png') }}" alt="" height="200px">
                </div>
            </div>
        </div>
    </div>
@endsection
