<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $password = Hash::make('password123');

        $users = [
            // 1 Admin
            [
                'name' => 'Administrator',
                'email' => 'admin@tokokita.com',
                'password' => $password,
                'role' => 'Admin',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // 3 Penjual
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@penjual.com',
                'password' => $password,
                'role' => 'Penjual',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@penjual.com',
                'password' => $password,
                'role' => 'Penjual',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Agus Yulianto',
                'email' => 'agus@penjual.com',
                'password' => $password,
                'role' => 'Penjual',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // 10 Pembeli
        $pembeliNames = [
            'Dewi Lestari', 'Joko Widodo', 'Rina Nose', 'Andi Arsyil', 
            'Fitri Tropica', 'Hendra Setiawan', 'Maya Septha', 'Reza Rahadian', 
            'Dian Sastrowardoyo', 'Nicholas Saputra'
        ];

        foreach ($pembeliNames as $index => $name) {
            $users[] = [
                'name' => $name,
                'email' => 'pembeli' . ($index + 1) . '@example.com',
                'password' => $password,
                'role' => 'Pembeli',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('users')->insert($users);
    }
}
