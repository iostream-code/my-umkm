<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Mas Roy',
                'email' => 'seller1@gmail.com',
                'password' => Hash::make('seller123'),
                'role' => 'seller',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Bu Lilis',
                'email' => 'seller2@gmail.com',
                'password' => Hash::make('seller234'),
                'role' => 'seller',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Mas Oni',
                'email' => 'seller3@gmail.com',
                'password' => Hash::make('seller345'),
                'role' => 'seller',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Suro',
                'email' => 'visitor1@gmail.com',
                'password' => Hash::make('visitor123'),
                'role' => 'visitor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Cici',
                'email' => 'visitor2@gmail.com',
                'password' => Hash::make('visitor234'),
                'role' => 'visitor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        User::insert($users);
    }
}
