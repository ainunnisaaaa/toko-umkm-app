<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShippingRateSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        $rates = [
            ['province' => 'DI Yogyakarta', 'city' => 'Yogyakarta', 'cost' => 10000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'DI Yogyakarta', 'city' => 'Sleman', 'cost' => 12000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'DI Yogyakarta', 'city' => 'Bantul', 'cost' => 11000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'Jawa Timur', 'city' => 'Surabaya', 'cost' => 20000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'Jawa Timur', 'city' => 'Malang', 'cost' => 25000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'Jawa Tengah', 'city' => 'Semarang', 'cost' => 18000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'Jawa Tengah', 'city' => 'Pekalongan', 'cost' => 15000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'DKI Jakarta', 'city' => 'Jakarta Selatan', 'cost' => 30000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'DKI Jakarta', 'city' => 'Jakarta Pusat', 'cost' => 30000, 'created_at' => $now, 'updated_at' => $now],
            ['province' => 'Jawa Barat', 'city' => 'Bandung', 'cost' => 28000, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('shipping_rates')->insert($rates);
    }
}
