<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShippingRateController;
use App\Http\Controllers\Admin\SalesSummaryController;

// Seller Controllers
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;

// Buyer Controllers
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Buyer\ReviewController;
use App\Http\Controllers\Buyer\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('home');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public Routes
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('reports/top-products-pdf', [\App\Http\Controllers\Admin\ReportController::class, 'topProductsPdf'])->name('reports.top-products');
    Route::get('reports/transactions-excel', [\App\Http\Controllers\Admin\ReportController::class, 'transactionsExcel'])->name('reports.transactions-excel');
    Route::get('reports/store-performance-excel', [\App\Http\Controllers\Admin\ReportController::class, 'storePerformanceExcel'])->name('reports.store-performance-excel');
    Route::get('reports/platform-commissions-excel', [\App\Http\Controllers\Admin\ReportController::class, 'platformCommissionsExcel'])->name('reports.platform-commissions-excel');
    Route::get('sales-summaries/pdf', [SalesSummaryController::class, 'exportPdf'])->name('sales-summaries.pdf');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('shipping-rates', ShippingRateController::class);
    Route::resource('sales-summaries', SalesSummaryController::class)->only(['index', 'show']);
});

// Seller Routes
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('products/pdf', [\App\Http\Controllers\Seller\ProductController::class, 'exportPdf'])->name('products.pdf');
    Route::get('products/excel', [\App\Http\Controllers\Seller\ProductController::class, 'exportExcel'])->name('products.excel');
    Route::get('orders/{order}/invoice', [SellerOrderController::class, 'invoicePdf'])->name('orders.invoice');
    Route::resource('stores', StoreController::class);
    Route::resource('products', \App\Http\Controllers\Seller\ProductController::class);
    Route::resource('orders', SellerOrderController::class);
});

// Buyer Routes
Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('orders/pdf', [BuyerOrderController::class, 'historyPdf'])->name('orders.pdf');
    Route::get('orders/{order}/invoice', [BuyerOrderController::class, 'invoicePdf'])->name('orders.invoice');
    Route::resource('carts', CartController::class);
    Route::resource('orders', BuyerOrderController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('wishlists', WishlistController::class);
});

require __DIR__.'/auth.php';
