<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products (Public Catalog).
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('store', 'category');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = \App\Models\Category::all();

        return view('welcome', compact('products', 'categories'));
    }
    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with(['store', 'reviews.user'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
