<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Traits\UploadImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    use UploadImage;

    public function run(): void
    {
        $stores = [
            [
                'user_id' => '2',
                'name' => 'Bakso Cinta',
                'email' => 'baksoCinta@gmail.com',
                'picture' => '',
                'location' => 'Bendul Merisi Selatan 47',
                'no_rek' => '126 000 711 115 5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '3',
                'name' => 'Martabak Krenyes',
                'email' => 'martabak@gmail.com',
                'picture' => '',
                'location' => 'Bendul Merisi Utara',
                'no_rek' => '0036 3498 4001',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '4',
                'name' => 'Penyetan Carkecor',
                'email' => 'penyetan@gmail.com',
                'picture' => '',
                'location' => 'Bendul Merisi Jaya',
                'no_rek' => '078 301 456 3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        Store::insert($stores);
    }
}
