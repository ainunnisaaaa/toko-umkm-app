<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesSummary extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'report_date', 'total_revenue', 'total_orders'];
    protected $casts = ['report_date' => 'date', 'total_revenue' => 'decimal:2', 'total_orders' => 'integer'];

    public function store() { return $this->belongsTo(Store::class); }

}
