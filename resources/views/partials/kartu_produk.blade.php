<div class="card kartu-produk h-100">
    <a href="{{ route('detail_produk', $product) }}">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
    </a>
    <div class="card-body p-3 d-flex flex-column">
        <a href="{{ route('detail_produk', $product) }}" class="text-decoration-none text-dark">
            <p class="fw-bold mb-1 lh-sm" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                {{ $product->name }}
            </p>
        </a>
        <p class="harga fs-5 mb-1">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
        <small class="text-muted mb-2">
            <i class="bi bi-shop me-1"></i>{{ $product->store->name }}
        </small>
        @auth
            @if ($product->store->user_id !== auth()->id())
                <form method="POST" action="{{ route('tambah_keranjang', $product) }}" class="mt-auto">
                    @csrf
                    <button class="btn btn-um btn-sm w-100"><i class="bi bi-cart-plus me-1"></i>Keranjang</button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-um-putih btn-sm w-100 mt-auto">
                <i class="bi bi-cart-plus me-1"></i>Keranjang
            </a>
        @endauth
    </div>
</div>
