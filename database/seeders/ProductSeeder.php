<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'store_id' => '1',
                'name' => 'Pentol Halus',
                'price' => '1000',
                'description' => 'Pentol halus tanpa gajih',
                'image' => '',
                'stock' => '900'
            ],
            [
                'store_id' => '1',
                'name' => 'Tahu Putih',
                'price' => '1000',
                'description' => 'Tahu putis kukus empuk',
                'image' => '',
                'stock' => '900'
            ],
            [
                'store_id' => '1',
                'name' => 'Gorengan Mie',
                'price' => '10500',
                'description' => 'Gorengan spesial dengan isian mie',
                'image' => '',
                'stock' => '800'
            ],
            [
                'store_id' => '2',
                'name' => 'Martabak Ayam',
                'price' => '18000',
                'description' => 'Martabak kriuk dengan isian daging ayam kampung',
                'image' => '',
                'stock' => '50'
            ],
            [
                'store_id' => '2',
                'name' => 'Martabak Kornet',
                'price' => '20000',
                'description' => 'Martabak kriuk dengan isian daging kornet sapi impor spesial',
                'image' => '',
                'stock' => '30'
            ],
            [
                'store_id' => '2',
                'name' => 'Martabak Spesial',
                'price' => '25000',
                'description' => 'Martabak kriuk dengan isian daging kornet sapi dan ayam kampung pilihan',
                'image' => '',
                'stock' => '20'
            ],
        ];
        Product::insert($products);
    }
}
