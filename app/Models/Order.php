<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'store_id', 'subtotal', 'shipping_cost', 'total_amount', 'status', 'payment_proof', 'receipt_number', 'shipping_address'];
    protected $casts = ['subtotal' => 'decimal:2', 'shipping_cost' => 'decimal:2', 'total_amount' => 'decimal:2'];

    public function user() { return $this->belongsTo(User::class); }
    public function store() { return $this->belongsTo(Store::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function reviews() { return $this->hasMany(Review::class); }

}
