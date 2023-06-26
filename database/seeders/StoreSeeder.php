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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => '3',
                'name' => 'Martabak Krenyes',
                'email' => 'martabak@gmail.com',
                'picture' => '',
                'location' => 'Bendul Merisi Utara',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        Store::insert($stores);
    }
}
