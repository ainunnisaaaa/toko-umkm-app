<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        $pembeliUsers = DB::table('users')->where('role', 'Pembeli')->get();
        $stores = DB::table('stores')->get();
        $products = DB::table('products')->get();
        
        if ($pembeliUsers->isEmpty() || $stores->isEmpty() || $products->isEmpty()) {
            return;
        }

        $statuses = [
            'Menunggu Pembayaran', 
            'Menunggu Verifikasi', 
            'Diproses', 
            'Dikirim', 
            'Selesai', 
            'Dibatalkan'
        ];

        // Ensure we create at least 100 orders
        $totalOrders = 100;
        
        for ($i = 0; $i < $totalOrders; $i++) {
            $buyer = $pembeliUsers->random();
            $store = $stores->random();
            
            // Get products belonging to this store
            $storeProducts = $products->where('store_id', $store->id);
            if ($storeProducts->isEmpty()) {
                continue;
            }
            
            $numItems = rand(1, 4);
            $selectedProducts = $storeProducts->random(min($numItems, $storeProducts->count()));
            
            $subtotal = 0;
            $itemsData = [];
            
            foreach ($selectedProducts as $product) {
                $qty = rand(1, 3);
                $price = $product->discount_price ?? $product->base_price;
                $subtotal += ($price * $qty);
                
                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $price,
                ];
            }
            
            $shippingCost = rand(1, 4) * 10000;
            $totalAmount = $subtotal + $shippingCost;
            $status = $statuses[array_rand($statuses)];
            
            // Random date within the last 30 days
            $orderDate = clone $now->subDays(rand(0, 30))->subHours(rand(0, 23));

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $buyer->id,
                'store_id' => $store->id,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total_amount' => $totalAmount,
                'status' => $status,
                'payment_proof' => in_array($status, ['Menunggu Pembayaran', 'Dibatalkan']) ? null : 'proof_' . rand(1000, 9999) . '.jpg',
                'receipt_number' => in_array($status, ['Dikirim', 'Selesai']) ? 'RESI' . rand(1000000, 9999999) : null,
                'shipping_address' => 'Jl. Pembeli No. ' . rand(1, 100) . ', Kota ' . rand(1, 50),
                'created_at' => $orderDate,
                'updated_at' => clone $orderDate->addHours(rand(1, 24)),
            ]);

            foreach ($itemsData as &$item) {
                $item['order_id'] = $orderId;
                $item['created_at'] = $orderDate;
                $item['updated_at'] = $orderDate;
            }
            
            DB::table('order_items')->insert($itemsData);
        }
    }
}
