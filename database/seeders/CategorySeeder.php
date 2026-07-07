<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Makanan & Minuman', 'icon' => 'fa-utensils', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kerajinan Tangan', 'icon' => 'fa-palette', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pakaian & Fashion', 'icon' => 'fa-tshirt', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kesehatan & Kecantikan', 'icon' => 'fa-spa', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Pertanian & Peternakan', 'icon' => 'fa-leaf', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('categories')->insert($categories);
    }
}
