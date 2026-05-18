<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Admin ORE',
                'email'    => 'admin@ore.com',
                'password' => Hash::make('password123'),
                'phone'    => '081234567890',
                'address'  => 'Jl. Sudirman No. 1, Jakarta Pusat',
                'role'     => 'admin',
            ],
            [
                'name'     => 'Budi Santoso',
                'email'    => 'budi@ore.com',
                'password' => Hash::make('password123'),
                'phone'    => '082345678901',
                'address'  => 'Jl. Malang Indah No. 12, Malang',
                'role'     => 'seller',
            ],
            [
                'name'     => 'Siti Rahayu',
                'email'    => 'siti@ore.com',
                'password' => Hash::make('password123'),
                'phone'    => '083456789012',
                'address'  => 'Jl. Raya Bogor No. 45, Surabaya',
                'role'     => 'seller',
            ],
            [
                'name'     => 'Andi Pratama',
                'email'    => 'andi@ore.com',
                'password' => Hash::make('password123'),
                'phone'    => '084567890123',
                'address'  => 'Jl. Gajah Mada No. 7, Bandung',
                'role'     => 'buyer',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}