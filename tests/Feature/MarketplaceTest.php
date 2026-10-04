<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketplaceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_beranda_dan_toko_terbuka_untuk_publik(): void
    {
        $this->get('/')->assertOk()->assertSee('Mau belanja apa');
        $this->get('/toko')->assertOk();
        $this->get('/toko/warung-bu-siti')->assertOk()->assertSee('Warung Bu Siti');
        $this->get('/produk/keripik-tempe-original-200g')->assertOk();
    }

    public function test_checkout_memecah_per_toko_dan_mengurangi_stok(): void
    {
        $andi = User::where('email', 'andi@demo.test')->first();
        $keripik = Product::where('slug', 'keripik-tempe-original-200g')->first();
        $stokAwal = $keripik->stock;

        Cart::create(['user_id' => $andi->id, 'product_id' => $keripik->id, 'amount' => 2]);

        $this->actingAs($andi)->post('/checkout', [
            'store_id' => $keripik->store_id,
            'recipient_name' => 'Andi',
            'phone' => '0812345',
            'address' => 'Jl. Tes 1',
        ])->assertRedirect();

        $order = Order::where('user_id', $andi->id)->latest('id')->first();
        $this->assertSame($keripik->store_id, $order->store_id);
        $this->assertSame(2 * $keripik->price, (int) $order->total);
        $this->assertSame($stokAwal - 2, $keripik->fresh()->stock);
        $this->assertSame(0, Cart::where('user_id', $andi->id)->count());
    }

    public function test_tidak_bisa_beli_produk_toko_sendiri(): void
    {
        $siti = User::where('email', 'siti@demo.test')->first();
        $keripik = Product::where('slug', 'keripik-tempe-original-200g')->first();

        $this->actingAs($siti)->post("/keranjang/{$keripik->slug}", ['amount' => 1]);
        $this->assertSame(0, Cart::where('user_id', $siti->id)->count());
    }

    public function test_bukti_bayar_webp_dan_hanya_pihak_terkait(): void
    {
        $andi = User::where('email', 'andi@demo.test')->first();
        $siti = User::where('email', 'siti@demo.test')->first();   // pemilik toko
        $budi = User::where('email', 'budi@demo.test')->first();   // orang lain
        $store = Store::where('slug', 'warung-bu-siti')->first();

        $order = Order::create([
            'user_id' => $andi->id, 'store_id' => $store->id,
            'status' => 'menunggu_pembayaran', 'total' => 30000,
        ]);

        \Illuminate\Support\Facades\Storage::fake('local');
        $file = \Illuminate\Http\UploadedFile::fake()->image('bukti.jpg', 600, 800);
        $this->actingAs($andi)->post("/pesanan/{$order->id}/bayar", ['payment_receipt' => $file])
            ->assertRedirect();

        $order->refresh();
        $this->assertStringEndsWith('.webp', $order->payment_receipt);
        $this->assertSame('menunggu_konfirmasi', $order->status);

        $this->actingAs($budi)->get("/pesanan/{$order->id}/bukti")->assertForbidden();
        $this->actingAs($siti)->get("/pesanan/{$order->id}/bukti")->assertOk();
        $this->actingAs($andi)->get("/pesanan/{$order->id}/bukti")->assertOk();
    }

    public function test_hanya_pemilik_toko_bisa_ubah_status_pesanan(): void
    {
        $andi = User::where('email', 'andi@demo.test')->first();
        $budi = User::where('email', 'budi@demo.test')->first();
        $store = Store::where('slug', 'warung-bu-siti')->first();

        $order = Order::create([
            'user_id' => $andi->id, 'store_id' => $store->id,
            'status' => 'menunggu_konfirmasi', 'total' => 30000,
        ]);

        $this->actingAs($budi)
            ->patch("/toko-saya/pesanan/{$order->id}", ['status' => 'diproses'])
            ->assertForbidden();
        $this->assertSame('menunggu_konfirmasi', $order->fresh()->status);
    }

    public function test_user_tanpa_toko_diarahkan_buka_toko(): void
    {
        $andi = User::where('email', 'andi@demo.test')->first();
        $this->actingAs($andi)->get('/toko-saya')->assertRedirect('/buka-toko');
    }
}
