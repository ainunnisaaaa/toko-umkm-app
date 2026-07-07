<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'category_id', 'name', 'description', 'base_price', 'discount_price', 'stock', 'image', 'is_active', 'rating'];
    protected $casts = ['base_price' => 'decimal:2', 'discount_price' => 'decimal:2', 'is_active' => 'boolean', 'rating' => 'float'];

    public function store() { return $this->belongsTo(Store::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function carts() { return $this->hasMany(Cart::class); }
    public function wishlists() { return $this->hasMany(Wishlist::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function reviews() { return $this->hasMany(Review::class); }

}
