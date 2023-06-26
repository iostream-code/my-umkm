@extends('layouts.home')

@section('content')
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-8 justify-content-center">
                @foreach ($stores as $store)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Store image-->
                            <img class="card-img-top" src="{{ url('storage/' . $store->picture) }}" alt="..." />
                            <!-- Store details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Store name-->
                                    <h5 class="fw-bolder">{{ $store->name }}</h5>
                                    <!-- Store price-->
                                    {{ $store->location }}
                                </div>
                            </div>
                            <!-- Store actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('detail_store', $store) }}">View
                                        Store</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
