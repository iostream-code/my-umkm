<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Menus</div>
                <a class="nav-link" href="{{ route('users') }}" {{ request()->is('user*') ? 'active' : '' }}>
                    <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                    User
                </a>
                <a class="nav-link" href="{{ route('stores') }}" {{ request()->is('store*') ? 'active' : '' }}>
                    <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                    Store
                </a>
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
