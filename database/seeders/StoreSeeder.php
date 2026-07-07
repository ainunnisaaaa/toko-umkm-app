<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        // Get all penjual users
        $penjualUsers = DB::table('users')->where('role', 'Penjual')->orderBy('id')->get();
        
        if ($penjualUsers->count() < 3) {
            return; // Safety check
        }

        $stores = [
            [
                'user_id' => $penjualUsers[0]->id,
                'name' => 'Kerajinan Rotan Makmur',
                'description' => 'Menyediakan berbagai macam kerajinan rotan asli dari pengrajin lokal berkualitas tinggi.',
                'address' => 'Jl. Pengrajin No. 12, Yogyakarta',
                'logo' => 'rotan_makmur.png',
                'rating' => 4.8,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $penjualUsers[1]->id,
                'name' => 'Sambal Bu Joko',
                'description' => 'Sambal khas rumahan dengan resep turun temurun. Pedasnya nampol, nikmatnya nagih!',
                'address' => 'Jl. Kuliner No. 8, Surabaya',
                'logo' => 'sambal_bujoko.png',
                'rating' => 4.9,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => $penjualUsers[2]->id,
                'name' => 'Batik Nusantara Emas',
                'description' => 'Pakaian batik pria dan wanita modern dengan motif klasik dan bahan nyaman dipakai.',
                'address' => 'Jl. Sudirman No. 45, Pekalongan',
                'logo' => 'batik_nusantara.png',
                'rating' => 4.7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('stores')->insert($stores);
    }
}
