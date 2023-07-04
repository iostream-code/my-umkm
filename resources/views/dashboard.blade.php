@extends('layouts.dashboard')

@section('content')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">My UMKM
                        </h1>
                        <p class="lead fw-normal text-white-50 mb-4">
                            Sebuah platform yang menjadi saran pengembangan UMKM khususnya di Kelurahan Bendul
                            Merisi, Surabaya. Dengan adanya platform ini tentu akan menjadikan Masyarakat yang
                            mempunyai UMKM lebih makmur!
                        </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#stores">Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <img class="img-fluid rounded-3 my-5" src="{{ asset('assets/img/home-banner.jpg') }}"
                        alt="home-banner" />
                </div>
            </div>
        </div>
    </header>
    <!-- Testimonial section-->
    <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-italic">
                            "Dengan adanya platform ini Kami harap dapat membantu masyarakat yang memiliki sumber
                            pengahasilan di sektor UMKM, khusunya di Kelurahan Bendul Merisi, Surabaya. Seperti
                            motto Kami yaitu Nyali Wani, Kami ingin berusaha sepenuhnya untuk benar-benar membantu
                            sektor UMKM supaya dapat lebih berkembang."
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="rounded-circle me-3" src="{{ asset('assets/img/person.jpg') }}" height="40"
                                alt="Bpk. Supaekan" />
                            <div class="fw-bold">
                                Bpk. Supaekan
                                <span class="fw-bold text-primary mx-1">/</span>
                                Kecamatan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Store preview section-->
    <section class="py-5" id="stores">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">Lihat Sekilas</h2>
                        <p class="lead fw-normal text-muted mb-5">
                            Beberapa UMKM yang sudah bergabung menjadi mitra UMKM.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="{{ asset('assets/img/store-banner-1.jpg') }}" alt="" />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Makanan</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <h5 class="card-title mb-3">Bakso Mas Roy</h5>
                            </a>
                            <p>
                                Jika Anda mencari hidangan bakso yang lezat, kenyal, dan menggugah selera, datanglah
                                ke tempat kami. Kami siap menyajikan pengalaman kuliner yang memuaskan dan memanjakan lidah
                                Anda dengan dagangan bakso yang istimewa.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d"
                                        alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Mas Roy</div>
                                        <div class="text-muted">March 12, 2023 &middot; 6 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="{{ asset('assets/img/store-banner-2.jpg') }}" alt="" />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Jajanan</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <h5 class="card-title mb-3">Martabak</h5>
                            </a>
                            <p class="card-text mb-0">Jika Anda mencari hidangan martabak yang lezat, renyah, dan
                                menggugah selera, datanglah ke tempat kami. Kami siap menyajikan pengalaman kuliner yang
                                memuaskan dan memanjakan lidah Anda dengan dagangan martabak yang istimewa.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d"
                                        alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Siti</div>
                                        <div class="text-muted">March 23, 2023 &middot; 4 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="{{ asset('assets/img/store-banner-3.jpg') }}" alt="" />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">Makanan</div>
                            <a class="text-decoration-none link-dark stretched-link" href="#!">
                                <h5 class="card-title mb-3">Penyetan Carkecor</h5>
                            </a>
                            <p class="card-text mb-0">Jika Anda mencari hidangan pedas yang lezat dan menggugah selera,
                                datanglah ke tempat kami. Kami siap menyajikan hidangan penyetan yang memuaskan dan
                                memanjakan lidah Anda dengan cita rasa pedas yang tak terlupakan.</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d"
                                        alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">Mas Oni</div>
                                        <div class="text-muted">April 2, 2023 &middot; 10 min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Call to action-->
            <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                <div
                    class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                    <div class="mb-4 mb-xl-0">
                        <div class="fs-3 fw-bold text-white">Warna baru untuk memulai usaha.</div>
                        <div class="text-white-50">Buat akun baru untuk merasakan bisnis UMKM warga Bendul Merisi.</div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
    </main>
    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright &copy; My UMKM 2023</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="#!">Privacy</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="#!">Terms</a>
                </div>
            </div>
        </div>
    </footer>
@endsection
