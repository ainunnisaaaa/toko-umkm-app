<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;

class ReviewTestSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Seller
        $seller = User::updateOrCreate(
            ['email' => 'seller.test@tokokita.com'],
            [
                'name' => 'Seller Test',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'is_active' => true,
            ]
        );

        // 2. Create Store
        $store = Store::updateOrCreate(
            ['user_id' => $seller->id],
            [
                'name' => 'Toko Review Test',
                'description' => 'Toko untuk test review',
                'address' => 'Jl. Test No. 1',
                'logo' => 'default-logo.png',
                'rating' => 0,
            ]
        );

        // 3. Create Category
        $category = Category::firstOrCreate(
            ['name' => 'Elektronik Test'],
            ['icon' => 'elektronik.png']
        );

        // 4. Create Product
        $product = Product::updateOrCreate(
            ['store_id' => $store->id, 'name' => 'Produk Review Test'],
            [
                'category_id' => $category->id,
                'description' => 'Produk ini untuk diuji reviewnya.',
                'base_price' => 100000,
                'discount_price' => 0,
                'stock' => 50,
                'image' => 'default-product.png',
                'is_active' => true,
                'rating' => 0,
            ]
        );

        // 5. Create Buyer
        $buyer = User::updateOrCreate(
            ['email' => 'buyer.review@tokokita.com'],
            [
                'name' => 'Buyer Review',
                'password' => Hash::make('password'),
                'role' => 'buyer',
                'is_active' => true,
            ]
        );

        // 6. Create Order with status 'Selesai'
        $order = Order::create([
            'user_id' => $buyer->id,
            'store_id' => $store->id,
            'subtotal' => 100000,
            'shipping_cost' => 10000,
            'total_amount' => 110000,
            'status' => 'Selesai',
            'shipping_address' => 'Alamat Pengiriman Test',
        ]);

        // 7. Create OrderItem
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 100000,
        ]);

        // Output to console for reference in tests
        $this->command->info("ReviewTestSeeder ran successfully.");
        $this->command->info("Buyer Email: buyer.review@tokokita.com");
        $this->command->info("Order ID: {$order->id}");
        $this->command->info("Product ID: {$product->id}");
    }
}
