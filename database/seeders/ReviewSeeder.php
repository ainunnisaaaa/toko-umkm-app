<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        // Only review completed orders
        $completedOrders = DB::table('orders')->where('status', 'Selesai')->get();
        
        $reviews = [];
        
        $comments = [
            'Barang bagus sesuai pesanan!',
            'Pengiriman cepat, packing rapi.',
            'Kualitas lumayan dengan harga segini.',
            'Sangat memuaskan, penjual ramah.',
            'Mantap, recommended seller!',
            'Sedikit kecewa karena warna kurang sesuai, tapi oke lah.',
            'Bagus banget, bakal beli lagi di sini.'
        ];

        foreach ($completedOrders as $order) {
            // Get order items to review
            $orderItems = DB::table('order_items')->where('order_id', $order->id)->get();
            
            foreach ($orderItems as $item) {
                // Not all items get reviewed (70% chance)
                if (rand(1, 10) > 3) {
                    $rating = rand(3, 5); // most reviews are good for dummy
                    
                    $reviews[] = [
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'user_id' => $order->user_id,
                        'rating' => $rating,
                        'comment' => $comments[array_rand($comments)],
                        'created_at' => clone Carbon::parse($order->created_at)->addDays(rand(1, 3)),
                        'updated_at' => clone Carbon::parse($order->created_at)->addDays(rand(1, 3))->addHours(1),
                    ];
                }
            }
        }

        if (!empty($reviews)) {
            DB::table('reviews')->insert($reviews);
        }
    }
}
