<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">My UMKM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link {{ request()->is('home*') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('store*') ? 'active' : '' }}"
                        href="{{ route('stores') }}">Store</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('order*') ? 'active' : '' }}"
                        href="{{ route('orders') }}">Order</a></li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="button"
                    onclick="window.location='{{ route('show_cart') }}'">
                    <i class="bi-cart-fill me-1"></i>
                    My Cart
                </button>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="{{ route('show_cart') }}">My Cart</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
