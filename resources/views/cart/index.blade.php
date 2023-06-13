@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('My Cart') }}
                        {{-- <button type="button" class="btn btn-success btn-sm"
                            onclick="window.location='{{ route('create_store') }}'"><i
                                class="bi bi-house-add me-1"></i>Create</button> --}}
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between align-items-start gap-2">
                            <div class="col-8">
                                <h4>My Cart.</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>nama produk</td>
                                            <td>gambar produk</td>
                                            <td>jumlah produk</td>
                                            <td>jumlah bayar</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex flex-row justify-content-between">
                                    <a class="btn btn-primary-outline btn-sm rounded-5" href="#">
                                        <i class="bi bi-arrow-left-short">
                                        </i> Back
                                    </a>
                                    <h6>Total: total bayar</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <h4>Payment Info.</h4>
                                </div>
                                <div class="row">
                                    <form action="" method="post">
                                        <h6>Payment Method</h6>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Cash on Delivery
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Transfer Bank
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Penerima</label>
                                            <input type="text" class="form-control" placeholder="Nama Panggilan">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Rumah</label>
                                            <input type="text" class="form-control" placeholder="Alamat pada Gmaps">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control" placeholder="Nomor Aktif">
                                        </div>
                                        <button class="btn btn-primary btn-sm">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
