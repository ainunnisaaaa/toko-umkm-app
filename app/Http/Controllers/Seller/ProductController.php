<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For now, listing all products (should be filtered by auth()->user()->store_id later)
        $products = Product::with('category')
            ->filter(request(['search', 'category', 'min_price', 'max_price']))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('seller.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, \App\Services\ProductService $productService)
    {
        $validated = $request->validated();
        
        $productService->createProduct(
            $validated,
            $request->file('image'),
            auth()->user()->store->id,
            $request->has('is_active')
        );

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('seller.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, \App\Services\ProductService $productService)
    {
        $validated = $request->validated();
        
        $productService->updateProduct(
            $product,
            $validated,
            $request->file('image'),
            $request->has('is_active')
        );

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus.');
    }
    /**
     * Export PDF report for product stock
     */
    public function exportPdf()
    {
        $storeId = auth()->user()->store->id ?? null;
        if (!$storeId) {
            abort(403, 'Anda belum memiliki toko.');
        }

        $products = Product::with('category')
            ->where('store_id', $storeId)
            ->latest()
            ->get();

        $pdf = Pdf::loadView('pdf.product-stock', compact('products'));
        return $pdf->download('laporan-stok-produk.pdf');
    }

    /**
     * Export Excel report for product stock
     */
    public function exportExcel()
    {
        $storeId = auth()->user()->store->id ?? null;
        if (!$storeId) {
            abort(403, 'Anda belum memiliki toko.');
        }

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\InventoryExport($storeId), 'laporan-stok-produk.xlsx');
    }
}
