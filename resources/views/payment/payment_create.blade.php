@extends('layouts.home')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('Payment Info') }}
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="bi bi-info-circle"></i>
                        </button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Payment Detail</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <h6><strong>Available Card</strong></h6>
                                            <p>112678356766 (mandiri)</p>
                                        </div>
                                        <div class="row">
                                            <h6><strong>How to Payment?</strong></h6>
                                            <p>
                                                (1) Choose the payment method there are available<br>(2) Fill the blank form
                                                under
                                                the payment method choice<br>(3) Submit payment<br>(4) Upload payment
                                                receipt
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-between align-items-start gap-2">
                            <div class="col-12">
                                <div class="row">
                                    <form action="{{ route('payment') }}" method="get">
                                        @csrf
                                        <h6><strong>Payment Method</strong></h6>
                                        <div class="d-flex flex-row gap-4 mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method1" value="0">
                                                <label class="form-check-label" for="payment_method1">
                                                    Cash on Delivery
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="payment_method2" value="1">
                                                <label class="form-check-label" for="payment_method2">
                                                    Transfer Bank
                                                </label>
                                            </div>
                                        </div>
                                        <h6><strong>Data Penerima</strong></h6>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Penerima</label>
                                            <input type="text" name="name" class="form-control" placeholder="Nama Panggilan">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Rumah</label>
                                            <input type="text" name="address" class="form-control" placeholder="Alamat pada Gmaps">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Nomor Aktif">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Checkout</button>
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
