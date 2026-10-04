<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $siti = User::firstOrCreate(['email' => 'siti@demo.test'],
            ['name' => 'Bu Siti', 'password' => Hash::make('password123')]);
        $budi = User::firstOrCreate(['email' => 'budi@demo.test'],
            ['name' => 'Pak Budi', 'password' => Hash::make('password123')]);
        $rina = User::firstOrCreate(['email' => 'rina@demo.test'],
            ['name' => 'Mbak Rina', 'password' => Hash::make('password123')]);
        User::firstOrCreate(['email' => 'andi@demo.test'],
            ['name' => 'Andi Pembeli', 'password' => Hash::make('password123')]);

        $toko = [
            [$siti, 'Warung Bu Siti', 'Magetan, Jawa Timur', 'Camilan rumahan renyah, dibuat segar setiap hari sejak 2015.', 'BRI', '002301001234567'],
            [$budi, 'Kriya Kayu Pak Budi', 'Jepara, Jawa Tengah', 'Kerajinan kayu jati asli Jepara, dikerjakan tangan.', 'BCA', '1234567890'],
            [$rina, 'Kopi Nusantara Rina', 'Takengon, Aceh', 'Biji kopi pilihan langsung dari petani Gayo.', 'Mandiri', '9876543210123'],
        ];
        $stores = [];
        foreach ($toko as [$user, $nama, $lokasi, $desc, $bank, $rek]) {
            $stores[$nama] = Store::firstOrCreate(
                ['email' => Str::slug($nama) . '@demo.test'],
                [
                    'user_id' => $user->id, 'name' => $nama, 'location' => $lokasi,
                    'description' => $desc, 'bank' => $bank, 'no_rek' => $rek,
                ]
            );
        }

        $produk = [
            ['Warung Bu Siti', 'Keripik Tempe Original 200g', 'Makanan', 15000, 50, 'Keripik tempe renyah gurih, tanpa pengawet. Camilan favorit keluarga.'],
            ['Warung Bu Siti', 'Rengginang Udang 250g', 'Makanan', 18000, 40, 'Rengginang gurih dengan udang asli, digoreng garing.'],
            ['Warung Bu Siti', 'Sambal Pecel Khas Magetan 200g', 'Makanan', 20000, 60, 'Bumbu pecel kacang asli Magetan, pedasnya pas.'],
            ['Warung Bu Siti', 'Sirup Jahe Merah 500ml', 'Minuman', 25000, 30, 'Sirup jahe merah hangat, cocok diminum malam hari.'],
            ['Kriya Kayu Pak Budi', 'Talenan Kayu Jati Ukir', 'Kerajinan', 45000, 25, 'Talenan jati tebal dengan ukiran tepi, awet puluhan tahun.'],
            ['Kriya Kayu Pak Budi', 'Rak Bumbu Dapur 3 Susun', 'Kerajinan', 85000, 15, 'Rak bumbu kayu jati 3 susun, rapi dan kokoh.'],
            ['Kriya Kayu Pak Budi', 'Mangkok Kayu Set Isi 4', 'Kerajinan', 95000, 18, 'Set mangkok kayu halus untuk sajian keluarga.'],
            ['Kopi Nusantara Rina', 'Kopi Gayo Arabika 250g', 'Minuman', 70000, 45, 'Biji arabika Gayo single origin, sangrai medium, notes cokelat.'],
            ['Kopi Nusantara Rina', 'Kopi Robusta Takengon 500g', 'Minuman', 60000, 35, 'Robusta mantap untuk kopi tubruk harian.'],
            ['Kopi Nusantara Rina', 'Gula Aren Semut 250g', 'Makanan', 22000, 55, 'Gula aren bubuk alami, manis legit pasangan kopi.'],
        ];
        foreach ($produk as $i => [$namaToko, $nama, $kategori, $harga, $stok, $desc]) {
            Product::firstOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'store_id' => $stores[$namaToko]->id,
                    'name' => $nama, 'category' => $kategori,
                    'price' => $harga, 'stock' => $stok, 'description' => $desc,
                    'image' => 'https://picsum.photos/seed/umkm' . ($i + 1) . '/600/600',
                ]
            );
        }
    }
}
