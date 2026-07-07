<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        $stores = DB::table('stores')->get();
        $categories = DB::table('categories')->get();

        if ($stores->isEmpty() || $categories->isEmpty()) {
            return;
        }

        // Store mappings for easier access
        $storeMap = [
            'Kerajinan Rotan Makmur' => $stores->where('name', 'Kerajinan Rotan Makmur')->first()->id ?? $stores->first()->id,
            'Sambal Bu Joko' => $stores->where('name', 'Sambal Bu Joko')->first()->id ?? $stores->first()->id,
            'Batik Nusantara Emas' => $stores->where('name', 'Batik Nusantara Emas')->first()->id ?? $stores->first()->id,
        ];

        $catMap = [
            'Kerajinan Tangan' => $categories->where('name', 'Kerajinan Tangan')->first()->id ?? $categories->first()->id,
            'Makanan & Minuman' => $categories->where('name', 'Makanan & Minuman')->first()->id ?? $categories->first()->id,
            'Pakaian & Fashion' => $categories->where('name', 'Pakaian & Fashion')->first()->id ?? $categories->first()->id,
        ];

        $products = [];
        
        // Products for Kerajinan Rotan Makmur
        for ($i = 1; $i <= 17; $i++) {
            $basePrice = rand(50, 300) * 1000;
            $hasDiscount = rand(1, 10) > 7; // 30% chance for discount
            $discountPrice = $hasDiscount ? $basePrice * rand(80, 95) / 100 : null;

            $products[] = [
                'store_id' => $storeMap['Kerajinan Rotan Makmur'],
                'category_id' => $catMap['Kerajinan Tangan'],
                'name' => 'Produk Anyaman Rotan Tipe ' . $i,
                'description' => 'Kerajinan anyaman rotan asli dibuat dengan tangan terampil, cocok untuk dekorasi rumah atau kebutuhan sehari-hari.',
                'base_price' => $basePrice,
                'discount_price' => $discountPrice,
                'stock' => rand(10, 100),
                'image' => 'rotan_' . $i . '.png',
                'is_active' => true,
                'rating' => rand(40, 50) / 10,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Products for Sambal Bu Joko
        for ($i = 1; $i <= 16; $i++) {
            $basePrice = rand(15, 50) * 1000;
            $hasDiscount = rand(1, 10) > 8; // 20% chance for discount
            $discountPrice = $hasDiscount ? $basePrice * rand(85, 95) / 100 : null;

            $products[] = [
                'store_id' => $storeMap['Sambal Bu Joko'],
                'category_id' => $catMap['Makanan & Minuman'],
                'name' => 'Sambal Botol Varian Rasa ' . $i,
                'description' => 'Sambal pedas nikmat dari bahan pilihan. Sangat pas untuk teman makan nasi hangat atau lauk lainnya.',
                'base_price' => $basePrice,
                'discount_price' => $discountPrice,
                'stock' => rand(20, 200),
                'image' => 'sambal_' . $i . '.png',
                'is_active' => true,
                'rating' => rand(45, 50) / 10,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Products for Batik Nusantara Emas
        for ($i = 1; $i <= 17; $i++) {
            $basePrice = rand(100, 500) * 1000;
            $hasDiscount = rand(1, 10) > 6; // 40% chance for discount
            $discountPrice = $hasDiscount ? $basePrice * rand(70, 90) / 100 : null;

            $products[] = [
                'store_id' => $storeMap['Batik Nusantara Emas'],
                'category_id' => $catMap['Pakaian & Fashion'],
                'name' => 'Kemeja/Tunik Batik Motif ' . $i,
                'description' => 'Pakaian batik berkualitas dengan kain katun halus. Desain modern yang tetap mempertahankan nilai tradisional.',
                'base_price' => $basePrice,
                'discount_price' => $discountPrice,
                'stock' => rand(5, 50),
                'image' => 'batik_' . $i . '.png',
                'is_active' => true,
                'rating' => rand(42, 50) / 10,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('products')->insert($products);
    }
}
