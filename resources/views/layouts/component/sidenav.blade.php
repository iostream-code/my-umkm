<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menus</div>
                @if (Auth::user()->role == 'admin')
                    <a class="nav-link" href="{{ route('users') }}" {{ request()->is('user*') ? 'active' : '' }}>
                        <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                        User
                    </a>
                    <a class="nav-link" href="{{ route('stores') }}" {{ request()->is('store*') ? 'active' : '' }}>
                        <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                        Store
                    </a>
                @else
                    <a class="nav-link" href="{{ route('stores') }}" {{ request()->is('store*') ? 'active' : '' }}>
                        <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                        Store
                    </a>
                    <a class="nav-link" href="{{ route('products') }}" {{ request()->is('product*') ? 'active' : '' }}>
                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                        Product
                    </a>
                    <a class="nav-link" href="{{ route('orders') }}" {{ request()->is('order*') ? 'active' : '' }}>
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Order
                    </a>
                    {{-- <a class="nav-link" href="{{ route('detail_user', $user) }}" {{ request()->is('profile*') ? 'active' : '' }}>
                        <div class="sb-nav-link-icon"><i class="bi bi-person-circle"></i></div>
                        Profile
                    </a> --}}
                @endif
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="nav-link">
                        <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-right"></i></div>
                        Logout
                    </button>
                </form>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name ?? '-' }}
        </div>
    </nav>
</div>
