<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    use HasFactory;

    protected $fillable = ['province', 'city', 'cost'];
    protected $casts = ['cost' => 'decimal:2'];

}
