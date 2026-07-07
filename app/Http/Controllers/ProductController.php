<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with(['store', 'reviews.user'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
