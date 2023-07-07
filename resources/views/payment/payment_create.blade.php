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
                                            <h6><strong>Bagaiamana melakukan pembayaran?</strong></h6>
                                            <p>Pastikan Anda mengetahui no. rekening toko tempat Anda belanja</p>
                                        </div>
                                        <div class="row">
                                            <a href="{{ route('stores') }}">
                                                <h6><strong>Klik disini!</strong></h6>
                                            </a>
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
                                    <form action="{{ route('checkout') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama Penerima</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Nama Panggilan">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Rumah</label>
                                            <input type="text" name="address" class="form-control"
                                                placeholder="Alamat pada Gmaps">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="Nomor Aktif">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pengiriman</label>
                                            <select name="delivery" class="form-select" aria-label="Pilih Metode Pengiriman">
                                                <option selected>-- Silahkan Pilih --</option>
                                                <option value="true">Ambil di Toko</option>
                                                <option value="false">Kirim ke Rumah</option>
                                            </select>
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
